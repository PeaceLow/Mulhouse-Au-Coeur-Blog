<?php
/**
 * Fonctions et definitions du theme Mulhouse au Coeur
 *
 * @package MulhouseAuCoeur
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Chargement des feuilles de style et polices
 */
function mac_enqueue_styles() {
	wp_enqueue_style(
		'mulhouse-au-coeur-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'mac_enqueue_styles' );

/**
 * Configuration initiale du site
 */
function mac_setup_site() {
	if ( get_option( 'mac_site_configured' ) ) {
		return;
	}

	update_option( 'blogname', 'Mulhouse au Coeur' );
	update_option( 'blogdescription', 'Media citoyen libre et participatif' );
	update_option( 'timezone_string', 'Europe/Paris' );
	update_option( 'date_format', 'j F Y' );
	update_option( 'WPLANG', 'fr_FR' );
	update_option( 'permalink_structure', '/%postname%/' );

	update_option( 'mac_site_configured', true );
}
add_action( 'init', 'mac_setup_site', 5 );

/**
 * Telecharge une image depuis une URL et l attache a un post
 */
function mac_sideload_image( $url, $post_id, $desc = '' ) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		return false;
	}

	$file_array = array(
		'name'     => 'mac-' . md5( $url ) . '.jpg',
		'tmp_name' => $tmp,
	);

	$attachment_id = media_handle_sideload( $file_array, $post_id, $desc );
	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		return false;
	}

	return $attachment_id;
}

/**
 * Contenu de demonstration
 */
function mac_seed_demo_content() {
	if ( get_option( 'mac_demo_v5' ) ) {
		return;
	}

	// Supprimer les anciens posts
	$old = get_posts( array( 'numberposts' => -1, 'post_status' => 'any' ) );
	foreach ( $old as $p ) {
		wp_delete_post( $p->ID, true );
	}

	// Supprimer les anciennes pages
	$old_pages = get_posts( array( 'numberposts' => -1, 'post_type' => 'page', 'post_status' => 'any' ) );
	foreach ( $old_pages as $p ) {
		wp_delete_post( $p->ID, true );
	}

	// Categories
	$cats = array(
		'decrypter' => 'Decrypter',
		'debattre'  => 'Debattre',
		'agir'      => 'Agir',
		'valoriser' => 'Valoriser',
	);

	$cat_ids = array();
	foreach ( $cats as $slug => $name ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term ) {
			$res = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
			if ( ! is_wp_error( $res ) ) {
				$cat_ids[ $slug ] = $res['term_id'];
			}
		} else {
			$cat_ids[ $slug ] = $term->term_id;
		}
	}

	// Articles
	$posts = array(
		array(
			'title'    => 'Transports en commun et mobilites douces : ou va le reseau mulhousien ?',
			'cat'      => 'decrypter',
			'excerpt'  => 'Alors que le plan de deplacement urbain fait debat, nous avons epluche les donnees de frequentation du tramway et les futurs amenagements cyclables.',
			'content'  => "<!-- wp:paragraph -->\n<p>Entre extensions de pistes cyclables et cadencement des lignes Solea, les choix d'investissements soulevent des questions cruciales pour le quotidien des habitants.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Dans cette enquete approfondie, nous revenons sur les investissements prevus par la collectivite et les solutions pragmatiques inspirees des villes voisines rhenanes.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1200&q=80',
			'date'     => '2026-09-26 10:00:00',
		),
		array(
			'title'    => 'Tribune : La place Franklin merite une veritable concertation avec ses residents',
			'cat'      => 'debattre',
			'excerpt'  => 'Point de vue de Karim B., commercant et membre du collectif des habitants de Franklin, qui appelle a repenser les usages par le dialogue.',
			'content'  => "<!-- wp:paragraph -->\n<p>On ne transforme pas un quartier historique a coups de decisions unilaterales. La vie de quartier repose sur la confiance et l'ecoute mutuelle.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>C'est pourquoi nous proposons l'organisation d'ateliers citoyens ouverts chaque trimestre pour coconstruire les futurs amenagements urbains.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=1200&q=80',
			'date'     => '2026-09-25 14:30:00',
		),
		array(
			'title'    => 'Vegetalisation participative : quand les habitants des Coteaux reinventent leurs cours',
			'cat'      => 'agir',
			'excerpt'  => 'Retour sur une operation citoyenne exemplaire menee samedi dernier par une trentaine de benevoles et familles du quartier.',
			'content'  => "<!-- wp:paragraph -->\n<p>Pelles et terreau en main, les residents ont transforme 400 m2 de dalles de beton en ilots de fraicheur et potagers partages.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Ce projet a mobilise trois associations locales et une vingtaine de familles. Il sera replique dans deux autres residences du quartier.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=1200&q=80',
			'date'     => '2026-09-24 09:15:00',
		),
		array(
			'title'    => 'Portrait : Sophie, artisane ceramiste qui fait rayonner le design a la Fonderie',
			'cat'      => 'valoriser',
			'excerpt'  => 'Installee dans les ateliers partages de la Fonderie, elle reinterprete les motifs historiques de l\'impression textile mulhousienne.',
			'content'  => "<!-- wp:paragraph -->\n<p>Mulhouse a une ame industrielle et creative unique en Alsace. Dans cet entretien, Sophie nous ouvre les portes de son atelier.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Avec trois autres artisans, elle organise des ateliers decouverte chaque mercredi pour les jeunes du quartier.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=1200&q=80',
			'date'     => '2026-09-23 16:00:00',
		),
		array(
			'title'    => 'Commerces de proximite : le grand defi de l\'attractivite du centre historique',
			'cat'      => 'decrypter',
			'excerpt'  => 'Loyer, stationnement, concurrence des zones commerciales : analyse chiffree des forces et des fragilites des boutiques independantes.',
			'content'  => "<!-- wp:paragraph -->\n<p>Comment redonner envie de flaner et de consommer au coeur de la ville ? Nous avons croise les donnees de vacance commerciale avec les temoignages des commercants.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Le taux de vacance commerciale atteint 18% dans certaines rues secondaires du centre, contre 8% il y a dix ans.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1519999482648-25049ddd37b1?w=1200&q=80',
			'date'     => '2026-09-22 11:30:00',
		),
		array(
			'title'    => 'Le collectif Mulhouse Respire lance une cartographie participative de la qualite de l\'air',
			'cat'      => 'agir',
			'excerpt'  => 'Equipes de micro-capteurs, des benevoles arpentent les rues pour mesurer les niveaux de pollution quartier par quartier.',
			'content'  => "<!-- wp:paragraph -->\n<p>Le collectif Mulhouse Respire a distribue 50 micro-capteurs de particules fines a des volontaires repartis dans les quartiers les plus exposes.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Les premieres donnees revelent des pics de pollution preoccupants aux heures de pointe. Une carte interactive sera mise en ligne prochainement.</p>\n<!-- /wp:paragraph -->",
			'image'    => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&q=80',
			'date'     => '2026-09-21 08:45:00',
		),
	);

	foreach ( $posts as $data ) {
		$cat_id = isset( $cat_ids[ $data['cat'] ] ) ? array( $cat_ids[ $data['cat'] ] ) : array();

		$post_id = wp_insert_post( array(
			'post_title'    => $data['title'],
			'post_content'  => $data['content'],
			'post_excerpt'  => $data['excerpt'],
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => $cat_id,
			'post_date'     => $data['date'],
		) );

		if ( $post_id && ! is_wp_error( $post_id ) && ! empty( $data['image'] ) ) {
			$att_id = mac_sideload_image( $data['image'], $post_id, $data['title'] );
			if ( $att_id ) {
				set_post_thumbnail( $post_id, $att_id );
			}
		}
	}

	if ( ! empty( $cat_ids['decrypter'] ) ) {
		update_option( 'default_category', $cat_ids['decrypter'] );
	}

	flush_rewrite_rules();
	update_option( 'mac_demo_v5', true );
}
add_action( 'init', 'mac_seed_demo_content', 20 );
