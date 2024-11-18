
<?php

// CPT

function criar_cpt_investimentos() {
    $labels = array(
        'name'                  => _x( 'Investimentos', 'Post Type General Name'),
        'singular_name'         => _x( 'Investimento', 'Post Type Singular Name'),
        'menu_name'             => __( 'Investimentos'),
        'add_new_item'          => __( 'Adicionar Novo Investimento'),
        'add_new'               => __( 'Adicionar Novo'),
        'edit_item'             => __( 'Editar Investimento'),
        'new_item'              => __( 'Novo Investimento'),
        'view_item'             => __( 'Ver Investimento'),
        'search_items'          => __( 'Procurar Investimentos'),
        'not_found'             => __( 'Não encontrado'),
        'not_found_in_trash'    => __( 'Nada na lixeira'),
        'all_items'             => __( 'Todos os Investimentos'),
    );
    $args = array(
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'investimentos' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 3,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies'         => array( 'category', 'post_tag' )
        );
    
    register_post_type( 'investimentos', $args );
    add_action( 'the_content', 'adicionar_botao_investir_apos_conteudo' );
}

   // Campos personalizados
function adicionar_metaboxes_investimentos() {
    add_meta_box(
        'metabox_investimentos',
        'Detalhes do Investimento',
        'exibir_metabox_investimentos',
        'investimentos',
        'normal',
        'high'
    );
}

function exibir_metabox_investimentos( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'metabox_investimentos_nonce' );

}

    // Campos personalizados
    ?>
    <table class="form-table">
        
        <tr>
        <th><label for="nome">Nome:</label></th>
        <td>
                <input type="text" name="nome" id="nome">
        </td>
        </tr>

    
        <tr>
        <th><label for="categoria">Categoria:</label></th>
        <td>
                <select name="categoria">
                    <option value="CDB">CDB</option>
                    <option value="Tesouro">Tesouro</option>
                    <option value="LCI_LCA">LCI e LCA</option>
                </select>
        </td>
        </tr>
        
        <tr>
        <th><label for="tipo_rentabilidade">Tipo de Rentabilidade:</label></th>
        <td>
                <select name="tipo_rentabilidade">
                    <option value="Pos-fixado">Pós-fixado</option>
                    <option value="Prefixado">Prefixado</option>
                    <option value="Inflacao">Inflação</option>
                </select>
        </td>
        </tr>

        <tr>
        <th><label for="risco">Risco:</label></th>
        <td>
                <select name="risco">
                    <option value="Baixo">Baixo</option>
                    <option value="Medio">Médio</option>
                    <option value="Alto">Alto</option>
                </select>
        </td>
        </tr>

        <tr>
        <th><label for="rentabilidade">Rentabilidade:</label></th>
        <td>
                <input type="text" name="rentabilidade" id="rentabilidade">
        </td>
        </tr>

        <tr>
        <th><label for="aplicacao_minima">Aplicação Miníma:</label></th>
        <td>
                <input type="number" name="aplicacao-minima" id="aplicacao-minima">
        </td>
        </tr>

        <tr>
        <th><label for="vencimento">Data de Vencimento:</label></th>
        <td>
                <input type="date" name="vencimento" id="vencimento">
        </td>
        </tr>

        <tr>
        <th><label for="link_CTA">Link CTA:</label></th>
        <td>
                <input type="text" name="link_CTA" id="link_CTA">
        </td>
        </tr>

        </table>

        <?php

function adicionar_botao_investir_apos_conteudo() {
    if ( 'investimentos' === get_post_type() ) {
        $link_cta = get_post_meta( get_the_ID(), 'link_CTA', true );

        if ( $link_cta ) {
            echo '<p><a href="' . esc_url( $link_cta ) . '" class="botao-investir">Investir</a></p>';
        }
    }
}

?>