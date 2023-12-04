<?php

function cl_form()
{
    $segmentos = cl_get_segmentos();

    $output = '';
    $output .= '<form id="cl-form" class="cl-form">';

    $output .=      '<label for="segmento">' . __('Selecione o seu segmento', 'cl') . '</label>';
    $output .=      '<select id="segmento" name="segmento" required="required">';

    $output .=          '<option value="">' . __('Selecione um segmento', 'cl') . '</option>';

    if ($segmentos) {
        foreach ($segmentos as $id => $post_title) {
            $output .=  '<option value="' . $id . '">' . $post_title . '</option>';
        }
    }

    $output .=      '</select>';

    $output .=      '<label for="faturamento">' . __('Quanto de faturamento você deseja por mês?', 'cl') . '</label>';
    $output .=      '<input type="text" id="faturamento" name="faturamento" required="required" />';

    $output .=      '<label for="ticket-medio">' . __('Qual é o seu ticket médio?', 'cl') . '</label>';
    $output .=      '<input type="text" id="ticket-medio" name="ticket-medio" required="required" />';

    // $output .=      '<label for="leads">' . __('Quantos leads seus vendedores atendem por mês?', 'cl') . '</label>';
    // $output .=      '<input type="text" id="leads" name="leads" required="required" />';

    $output .=      '<button>' . __('Calcular', 'cl') . '</button>';

    $output .=      '<div class="cl-form-messages" id="cl-form-messages">';

    // $output .=          '<ul class="cl-form-messages-errors">';
    // $output .=              '<li>Mensagem de erro! Alguma coisa deu <strong>errado</strong>.</li>';
    // $output .=              '<li>Mensagem de erro! Alguma coisa deu <strong>errado</strong>.</li>';
    // $output .=              '<li>Mensagem de erro! Alguma coisa deu <strong>errado</strong>.</li>';
    // $output .=          '</ul>';
    
    // $output .=          '<ul class="cl-form-messages-warning">';
    // $output .=              '<li>Mensagem de aviso! Esta mensagem é <strong>importante</strong>.</li>';
    // $output .=              '<li>Mensagem de aviso! Esta mensagem é <strong>importante</strong>.</li>';
    // $output .=              '<li>Mensagem de aviso! Esta mensagem é <strong>importante</strong>.</li>';
    // $output .=          '</ul>';

    // $output .=          '<ul class="cl-form-messages-success">';
    // $output .=              '<li>Mensagem de sucesso! Deu tudo <strong>certo</strong>.</li>';
    // $output .=              '<li>Mensagem de sucesso! Deu tudo <strong>certo</strong>.</li>';
    // $output .=              '<li>Mensagem de sucesso! Deu tudo <strong>certo</strong>.</li>';
    // $output .=          '</ul>';

    $output .=      '</div>';

    $output .= '</form>';

    return $output;
}

add_shortcode('cl_form', 'cl_form');

function cl_resultados()
{
    $output = '';
    $output .= '<div id="cl-resultados" class="cl-resultados">';

    $output .=      '<h3>' . __('Aqui está seu resultado', 'cl') . '</h3>';
    $output .=      '<p>' . __('Abaixo você encontra a projeção de vendas de acordo com sua área de atuação.', 'cl') . '</p>';

    $output .=      '<div class="cl-resultados-2-col">';

    $output .=          '<div class="cl-trapezoides">';

    $output .=              '<div class="cl-trapezoid" id="cl-trapezoid-1">';
    $output .=                  '<div class="cl-big-number" id="resultado-visitantes-unicos">0</div>';
    $output .=                  '<div class="cl-description">' . __('Visitantes Únicos', 'cl') . '</div>';
    $output .=                  '<div class="cl-pct" id="visitantes_leads">0%</div>';
    $output .=              '</div>';

    $output .=              '<div class="cl-trapezoid" id="cl-trapezoid-2">';
    $output .=                  '<div class="cl-big-number" id="resultado-assinantes-e-leads">0</div>';
    $output .=                  '<div class="cl-description">' . __('assinantes e leads', 'cl') . '</div>';
    $output .=                  '<div class="cl-pct" id="leads_oportunidades">0%</div>';
    $output .=              '</div>';

    $output .=              '<div class="cl-trapezoid" id="cl-trapezoid-3">';
    $output .=                  '<div class="cl-big-number" id="resultado-oportunidades">0</div>';
    $output .=                  '<div class="cl-description">' . __('Oportunidades', 'cl') . '</div>';
    $output .=                  '<div class="cl-pct" id="oportunidades_vendas">0%</div>';
    $output .=              '</div>';

    $output .=              '<div class="cl-trapezoid" id="cl-trapezoid-4">';
    $output .=                  '<div class="cl-big-number" id="resultado-vendas">0</div>';
    $output .=                  '<div class="cl-description">' . __('Vendas', 'cl') . '</div>';
    $output .=              '</div>';

    $output .=          '</div>';

    $output .=          '<div class="cl-resultados-col">';

    $output .=              '<ul class="cl-resultados-lista">';
    $output .=                  '<li><span id="resultado-vendas-desejadas">0</span> ' . __('vendas desejadas', 'cl') . '</li>';
    $output .=                  '<li><span id="resultado-taxas-conversao">0%</span> ' . __('taxa de coversão', 'cl') . '</li>';
    // $output .=                  '<li><span id="resultado-vendedores-necessarios">0</span> ' . __('vendedores necessários', 'cl') . '</li>';
    // $output .=                  '<li><span id="resultado-leads-atendidos">0</span> ' . __('Leads atendidos', 'cl') . '</li>';
    // $output .=                  '<li><span id="resultado-vendas-realizadas">0</span> ' . __('Vendas realizadas', 'cl') . '</li>';
    $output .=              '</ul>';

    $output .=          '</div>';

    $output .=      '</div>';

    $output .= '</div>';
    return $output;
}

add_shortcode('cl_resultados', 'cl_resultados');
