<?php 
/**
 * Register meta box(es).
 */
function wp_register_meta_box_cadastro() {
    add_meta_box(
		'wp_display_vendas_clube_lider', // Identificador
		'Dados do usuário', // Titulo do metabox
		'wp_call_back_cadastro', // chama a função que irá renderizar o metabox
		'cadastro', // post type pertencente
		'normal', // posição
		'high' // prioridade de exibição
	);
}
add_action( 'add_meta_boxes', 'wp_register_meta_box_cadastro' );

// renderiza os campos no metabox
function wp_call_back_cadastro() {
    global $post;
    $email                  = get_post_meta( $post->ID, 'email', true );
    $telefone               = get_post_meta( $post->ID, 'telefone', true );
    $celular                = get_post_meta( $post->ID, 'celular', true );
    $aceito                 = get_post_meta( $post->ID, 'aceito-contato', true );
    $aceitoContato               = get_post_meta($post->ID, 'aceito-contato', true);
    $dispositivo            = get_post_meta( $post->ID, 'dispositivo', true );
    $sistema                = get_post_meta( $post->ID, 'sistema', true );
    $observacao             = get_post_meta( $post->ID, 'observacao', true );
    ?>
    <table class="table" width="100%" cellpadding="10">
        <tbody>
            <tr>
                <td scope="row">
                    <div class="form-group">
                        <strong> E-mail </strong> <br>
                        <?= $email ?>
                    </div>
                </td>
                <td scope="row">
                    <div class="form-group">
                        <strong> Telefone </strong> <br>
                        <?= $telefone ?>
                    </div>
                </td>
                <td scope="row">
                    <div class="form-group">
                        <strong> Celular </strong> <br>
                        <?= $celular ?>
                    </div>
                </td>

            </tr>
            <tr>
                <td scope="row">
                    <div class="form-group">
                        <?= $aceito ?>
                    </div>
                </td>
                <td scope="row">
                    <div class="form-group">
                        <?= $aceitoContato ?>
                    </div>
                </td>
                <td>
                    Sistema em Uso:
                    <?= $sistema ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?php	
}