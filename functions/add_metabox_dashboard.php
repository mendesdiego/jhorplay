<?php 
// Function used in the action hook
function add_dashboard_cadastros_box() {
	wp_add_dashboard_widget('dashboard_widget', 'Cadastros/Feedbacks enviados', 'dashboard_callback_box');
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'add_dashboard_cadastros_box' );

// Function that outputs the contents of the dashboard widget
function dashboard_callback_box( $post, $callback_args ) {
    $argCadastros = array(
        'post_type' => 'cadastro',
        'posts_per_page'    => -1
    );
    $cadastros = new WP_Query($argCadastros);

    $argFeddback = array(
        'post_type' => 'feedback',
        'posts_per_page'    => -1
    );
    $feedback = new WP_Query($argFeddback);

    $cadastrosFeitos = wp_count_posts($post_type = 'cadastro');
    $feedbackFeitos = wp_count_posts($post_type = 'feedback');
    echo "<table border='1' width='100%' cellpadding='5' cellspacing='0'>";
        echo "<tr>";
            echo "<th> Cadastros aprovados </td>";
            echo "<th> Cadastros pendentes </td>";
            echo "<th> Total Cadastros </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td align='center'>";
                echo $cadastrosFeitos->publish;
            echo "</td>";
            echo "<td align='center'>";
                echo $cadastrosFeitos->draft;
            echo "</td>";
            echo "<td align='center'>";
                echo $cadastros->post_count;
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th> Feedbacks aprovados </td>";
            echo "<th> Feedbacks pendentes </td>";
            echo "<th> Total Feedbacks </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td align='center'>";
                echo $feedbackFeitos->publish;
            echo "</td>";
            echo "<td align='center'>";
                echo $feedbackFeitos->draft;
            echo "</td>";
            echo "<td align='center'>";
                echo $feedback->post_count;
            echo "</td>";
        echo "</tr>";
    echo "</table>";
    echo "<hr>";
    echo "<a href='http://unimed-testeapp.test/wp-admin/tools.php?page=Simple_CSV_Exporter_Settings&export=xls&post_type=feedback' class='button button-primary'> Baixar lista Feedbacks </a>";
    echo " | <a href='http://unimed-testeapp.test/wp-admin/tools.php?page=Simple_CSV_Exporter_Settings&export=xls&post_type=cadastro' class='button button-primary'> Baixar lista Cadastros </a>";
}

