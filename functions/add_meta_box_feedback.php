<?php 
/**
 * Register meta box(es).
 */
function wp_register_meta_box_feedback() {
    add_meta_box(
		'wp_display_vendas_clube_lider', // Identificador
		'Dados do usuário', // Titulo do metabox
		'wp_call_back_feedback', // chama a função que irá renderizar o metabox
		'feedback', // post type pertencente
		'normal', // posição
		'high' // prioridade de exibição
	);
}
add_action( 'add_meta_boxes', 'wp_register_meta_box_feedback' );

// renderiza os campos no metabox
function wp_call_back_feedback() {
    global $post;
    $email               = get_post_meta( $post->ID, 'email', true );
    $telefone            = get_post_meta( $post->ID, 'telefone', true );
    $aceito              = get_post_meta( $post->ID, 'aceito', true );
    $dispositivo         = get_post_meta( $post->ID, 'dispositivo', true );
    $sistema             = get_post_meta( $post->ID, 'sistema', true );
    $observacao          = get_post_meta( $post->ID, 'observacao', true );
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
                        <strong> Termo de aceite </strong> <br>
                        <?php
                            if($aceito == 1){
                                echo "O Cliente aceita participar";
                            } else {
                                echo "Campo aceite não preenchido";
                            }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Dispositivo </strong> <br> 
                    <?= $dispositivo ?>
                </td>
                <td>
                    <strong> Sistema utilizado</strong> <br>
                    <?= $sistema ?>
                </td>
                <td>
                    <strong> Observação </strong> <br>
                    <?= $observacao ?>
                </td>
            </tr>
        </tbody>
    </table>
    <h3> Imagens em anexo </h3>
    <table>
        <tr>
            <td>
                <img src="<?= wp_get_attachment_url( get_post_meta($post->ID, '_my_file_upload', true) ) ?>" alt="" width="200">

            </td>
        </tr>
    </table>
    <?php	
}