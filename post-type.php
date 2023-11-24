<?php

$segmento = new CL_Post_Type('Segmento', 'segmento');

$segmento->set_arguments(array('supports' => array('title')));

$segmento->set_labels(array(
    'name'               => sprintf(__('%ss', 'cl'), 'Segmento'),
    'singular_name'      => sprintf(__('%s', 'cl'), 'Segmento'),
    'view_item'          => sprintf(__('Visualizar %s', 'cl'), 'Segmento'),
    'edit_item'          => sprintf(__('Editar %s', 'cl'), 'Segmento'),
    'search_items'       => sprintf(__('Pesquisar %s', 'cl'), 'Segmento'),
    'update_item'        => sprintf(__('Atualizar %s', 'cl'), 'Segmento'),
    'parent_item_colon'  => sprintf(__('%s pai:', 'cl'), 'Segmento'),
    'menu_name'          => sprintf(__('%ss', 'cl'), 'Segmento'),
    'add_new'            => __('Adicionar novo', 'cl'),
    'add_new_item'       => sprintf(__('Adicionar novo %s', 'cl'), 'Segmento'),
    'new_item'           => sprintf(__('Novo %s', 'cl'), 'Segmento'),
    'all_items'          => sprintf(__('Todos %ss', 'cl'), 'Segmento'),
    'not_found'          => sprintf(__('Nenhum %s encontrado', 'cl'), 'Segmento'),
    'not_found_in_trash' => sprintf(__('Nenhum %s encontrado na lixeira', 'cl'), 'Segmento')
));