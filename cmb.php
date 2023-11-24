<?php

add_action('cmb2_admin_init', 'cl_register_segmento_metabox');

function cl_register_segmento_metabox()
{
    /**
     * Sample metabox to demonstrate each field type included
     */
    $segmento = new_cmb2_box(array(
        'id'            => 'cl_segmento_metabox',
        'title'         => esc_html__('Opções', 'cl'),
        'object_types'  => array('segmento'), // Post type
    ));

    $segmento->add_field(array(
        'name'       => esc_html__('De visitantes para leads', 'cl'),
        'desc'       => esc_html__('%', 'cl'),
        'id'         => 'cl_segmento_visitantes_leads',
        'default'       => '0',
        'type'       => 'text_small',
        'attributes' => array(
            'required'      =>'required',
            'type'          => 'number',
            'min'           => '0',
            'max'           => '100',
            'step'          => '0.01'
            )
    ));

    $segmento->add_field(array(
        'name'       => esc_html__('De leads para oportunidades', 'cl'),
        'desc'       => esc_html__('%', 'cl'),
        'id'         => 'cl_segmento_leads_oportunidades',
        'default'       => '0',
        'type'       => 'text_small',
        'attributes' => array(
            'required'      =>'required',
            'type'          => 'number',
            'min'           => '0',
            'max'           => '100',
            'step'          => '0.01'
            )
    ));

    $segmento->add_field(array(
        'name'       => esc_html__('De oportunidades para vendas', 'cl'),
        'desc'       => esc_html__('%', 'cl'),
        'id'         => 'cl_segmento_oportunidades_vendas',
        'default'       => '0',
        'type'       => 'text_small',
        'attributes' => array(
            'required'      =>'required',
            'type'          => 'number',
            'min'           => '0',
            'max'           => '100',
            'step'          => '0.01'
            )
    ));

}
