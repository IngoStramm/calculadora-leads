<?php

function cl_get_segmentos()
{
    $args = array(
        'numberposts'               => -1,
        'orderby'                   => 'name',
        'order'                     => 'ASC',
        'post_type'                 => 'segmento'
    );

    $segmentos = get_posts($args);
    $array = [];
    if ($segmentos) {
        foreach ($segmentos as $segmento) {
            $array[$segmento->ID] = $segmento->post_title;
        }
        wp_reset_postdata();
    }
    return $array;
}

function cl_get_field_value($name)
{
    $value = isset($_POST[$name]) && !is_null($_POST[$name]) ? $_POST[$name] : null;
    if (!$value) {
        // retorna uma mensagem de erro com o campo 'success' falso
        wp_send_json_error(array('msg' => __("Campo \"$name\" não foi passado ou está vazio.", 'cl')), 200);
    }
    return $value;
}

function cl_get_meta_value($name, $post_id)
{
    $value = get_post_meta($post_id, $name, true);
    if (!$value) {
        // retorna uma mensagem de erro com o campo 'success' falso
        return wp_send_json_error(array('msg' => __("Campo \"$name\" do segmento selecionado não foi encontrado.", 'cl')), 200);
    }
    return $value;
}

add_action('wp_ajax_nopriv_cl_calcula_leads', 'cl_calcula_leads');
add_action('wp_ajax_cl_calcula_leads', 'cl_calcula_leads');

function cl_calcula_leads()
{
    $fields = array('segmento', 'faturamento', 'ticket-medio', 'leads');
    $data = [];
    foreach ($fields as $name) {
        $data[$name] = cl_get_field_value($name);
    }
    $post_id = $data['segmento'];
    $post = get_post($post_id);

    if (is_null($post)) {
        wp_send_json_error(array('msg' => __('Segmento não encontrado', 'cl')), 200);
    }

    $visitantes_leads_pct = get_post_meta($post_id, 'cl_segmento_visitantes_leads', true);
    if (!$visitantes_leads_pct) {
        return wp_send_json_error(array('msg' => __("Campo \"cl_segmento_visitantes_leads\" do segmento selecionado não foi encontrado.", 'cl')), 200);
    }

    $leads_oportunidades_pct = get_post_meta($post_id, 'cl_segmento_leads_oportunidades', true);
    if (!$leads_oportunidades_pct) {
        return wp_send_json_error(array('msg' => __("Campo \"cl_segmento_leads_oportunidades\" do segmento selecionado não foi encontrado.", 'cl')), 200);
    }

    $oportunidades_vendas_pct = get_post_meta($post_id, 'cl_segmento_oportunidades_vendas', true);
    if (!$oportunidades_vendas_pct) {
        return wp_send_json_error(array('msg' => __("Campo \"cl_segmento_leads_oportunidades\" do segmento selecionado não foi encontrado.", 'cl')), 200);
    }

    $vendas = floatval($data['faturamento']) / floatval($data['ticket-medio']);
    $vendas_pct_calculada = floatval($oportunidades_vendas_pct) / 100;
    $oportunidades_vendas = floor($vendas / $vendas_pct_calculada);

    $oportunidades_vendas_pct_calculada = floatval($leads_oportunidades_pct) / 100;
    $leads_oportunidades = floor($oportunidades_vendas / $oportunidades_vendas_pct_calculada);

    $visitantes_leads_pct_calculada = floatval($visitantes_leads_pct) / 100;
    $visitantes_leads = floor($leads_oportunidades / $visitantes_leads_pct_calculada);

    $taxa_conversao = ($vendas / $visitantes_leads) * 100;
    $taxa_conversao = round($taxa_conversao, 2);

    $vendedores_necessarios = ceil($oportunidades_vendas / floatval($data['leads']));

    $leads_atendidos = ceil($oportunidades_vendas / $vendedores_necessarios);

    $vendas_realizadas = ceil($vendas / $vendedores_necessarios);


    $response = array(
        'visitantes_leads_pct'                  => $visitantes_leads_pct,
        'leads_oportunidades_pct'               => $leads_oportunidades_pct,
        'oportunidades_vendas_pct'              => $oportunidades_vendas_pct,
        'vendas'                                => $vendas,
        'vendas_pct_calculada'                  => $vendas_pct_calculada,
        'oportunidades_vendas'                  => $oportunidades_vendas,
        'leads_oportunidades'                   => $leads_oportunidades,
        'visitantes_leads'                      => $visitantes_leads,
        'taxa_conversao'                        => $taxa_conversao,
        'vendedores_necessarios'                => $vendedores_necessarios,
        'leads_atendidos'                       => $leads_atendidos,
        'vendas_realizadas'                     => $vendas_realizadas
    );

    wp_send_json_success($response);
}

// add_action('wp_head', 'teste');
function teste()
{
    $visitantes_leads_pct = get_post_meta(7049, 'cl_segmento_visitantes_leads', true);
    cl_debug($visitantes_leads_pct);
}
