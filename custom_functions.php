<?php
/* Índice:
* Genesis - Customização dos Breadcrumbs
* Genesis - Customização do título da caixa de busca
* Genesis - Customização do texto de pesquisa dentro da caixa de busca
* Genesis - Customização da função post meta
* Genesis - Customização dos textos para os links das páginas
* Genesis - Modifica o texto do link de comentários
* Genesis - Modifica o texto comentários
* Genesis - Customização dos créditos da página
* Genesis - Cria novo widget
* Genesis - Mostra o widget no tema (em uma página específica)
* WordPress - Modifica o texto o "autor diz" nos comentários
* WordPress - Customiza o botão enviar nos comentários
* WordPress - Modifica o título dos comentários
* WordPress - Modifica o link do WordPress leia mais
*/

// Customização dos Breadcrumbs
add_filter('genesis_breadcrumb_args', 'lebrandt_breadcrumb_args');

function lebrandt_breadcrumb_args($args)
	{
	$args['home'] = 'Home';
	$args['sep'] = ' / ';
	$args['list_sep'] = ', ';
	$args['prefix'] = '<div class="breadcrumb">';
	$args['suffix'] = '</div>';
	$args['heirarchial_attachments'] = true;
	$args['heirarchial_categories'] = true;
	$args['display'] = true;
	$args['labels']['prefix'] = 'Você está aqui: ';
	$args['labels']['author'] = 'Arquivos de ';
	$args['labels']['category'] = 'Arquivos de ';
	$args['labels']['tag'] = 'Arquivos de ';
	$args['labels']['date'] = 'Arquivos de ';
	$args['labels']['search'] = 'Procurar por ';
	$args['labels']['tax'] = 'Arquivos de ';
	$args['labels']['post_type'] = 'Arquivos de ';
	$args['labels']['404'] = 'Não encontrado: ';
	return $args;
	}

// Customização do título da caixa de busca
add_filter('genesis_search_title_text', 'lebrandt_titulo_busca');

function lebrandt_titulo_busca()
	{
	return 'Resultados da sua busca:';
	}

// Customização do texto de pesquisa dentro da caixa de busca
add_filter('genesis_search_text', 'lebrandt_texto_busca');

function lebrandt_texto_busca($texto)
	{
	return esc_attr('Pesquisar');
	}

// Customização da função post meta
add_filter('genesis_post_meta', 'lebrandt_post_meta');

function lebrandt_post_meta($post_meta)
	{
	if (!is_page())
		{
		$post_meta = '[post_categories before="Categoria(s): "] [post_tags before="Marcado como: "]';
		return $post_meta;
		}
	}

// Customização dos textos para os links das páginas
add_filter('genesis_prev_link_text', 'lebrandt_link_anterior');

function lebrandt_link_anterior($text)
	{
	$text = 'Anterior';
	return $text;
	}

add_filter('genesis_next_link_text', 'lebrandt_link_proximo');

function lebrandt_link_proximo($text)
	{
	$text = 'Próximo';
	return $text;
	}

// Modifica o texto do link de comentários
add_filter('genesis_post_info', 'lebrandt_post_info_filtro');

function lebrandt_post_info_filtro($post_info)
	{
	return '[post_comments zero="Deixe um Comentário" one="1 Comentário" more="% Comentários"]';
	}

// Modifica o texto comentários
add_filter('genesis_title_comments', 'lebrandt_genesis_title_comments');

function lebrandt_genesis_title_comments()
	{
	$title = '<h3>Comentários</h3>';
	return $title;
	}

// Customização dos créditos da página
add_filter('genesis_footer_creds_text', 'lebrandt_texto_credito');

function lebrandt_texto_credito()
	{
?>
    <p>&copy; Copyright <?php
	echo date(' Y '); ?><a href="#">Nome da Companhia</a> &middot; <a href="http://exemplo.com.br/">Desenvolvido por Lebrandt</a></p>
    <?php
	}

// Cria novos widgets
genesis_register_sidebar( array(
    'id'          => 'nome',
    'name'        => __( 'Nome do Widget', 'lebrandt' ),
    'description' => __( 'Descrição do widget.', 'lebrandt' ),
) );

// Mostra o widget no tema em uma página específica
add_action( 'genesis_before', 'lebrandt_adicionar_widget' );

function lebrandt_adicionar_widget()
	{
    if ( is_page( '12' ) )
    genesis_widget_area ('nome', array(
        'before'  => '<div class="nome"><div class="wrap">',
        'after'   => '</div></div>',
    ) );
	}

// Modifica o texto o "autor diz" nos comentários
add_filter('comment_author_says_text', 'lebrandt_autor_diz');

function lebrandt_autor_diz()
	{
	return 'o autor diz';
	}

// Customiza o botão enviar nos comentários
add_filter('comment_form_defaults', 'lebrandt_botao_enviar');

function lebrandt_botao_enviar($defaults)
	{
	$defaults['label_submit'] = __('Enviar', 'custom');
	return $defaults;
	}

// Modifica o título dos comentários
add_filter('comment_form_defaults', 'lebrandt_deixe_comentario');

function lebrandt_deixe_comentario($defaults)
	{
	$defaults['title_reply'] = __('Deixe o seu comentário aqui');
	return $defaults;
	}

// Modifica o link do WordPress leia mais
add_filter('the_content_more_link', 'lebrandt_leia_mais');

function lebrandt_leia_mais()
	{
	return '<a class="more-link" href="' . get_permalink() . '">Continue Lendo</a>';
	}