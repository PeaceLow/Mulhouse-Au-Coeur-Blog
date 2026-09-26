<?php
/**
 * Fonctions et définitions du thème Mulhouse au Cœur
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
 * Initialisation automatique des catégories et articles de démonstration
 */
function mac_seed_demo_content() {
	// Ne pas réexécuter si le contenu de démo a déjà été créé
	if ( get_option( 'mac_demo_content_installed' ) ) {
		return;
	}

	// 1. Création des catégories éditoriales officielles
	$categories = array(
		'decrypter' => array(
			'name'        => 'Décrypter',
			'description' => 'Comprendre les décisions, dossiers de fond, chiffres et analyses locales de Mulhouse.',
		),
		'debattre'  => array(
			'name'        => 'Débattre',
			'description' => 'Tribunes citoyennes, interviews croisées, opinions et confrontations d’idées.',
		),
		'agir'      => array(
			'name'        => 'Agir',
			'description' => 'Initiatives concrètes, événements, mobilisations de quartier et propositions citoyennes.',
		),
		'valoriser' => array(
			'name'        => 'Valoriser',
			'description' => 'Portraits de Mulhousiens : habitants, associations, créateurs et acteurs économiques.',
		),
	);

	$cat_ids = array();
	foreach ( $categories as $slug => $data ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term ) {
			$res = wp_insert_term( $data['name'], 'category', array(
				'slug'        => $slug,
				'description' => $data['description'],
			) );
			if ( ! is_wp_error( $res ) ) {
				$cat_ids[ $slug ] = $res['term_id'];
			}
		} else {
			$cat_ids[ $slug ] = $term->term_id;
		}
	}

	// 2. Création des articles types réalistes pour Mulhouse
	$demo_posts = array(
		array(
			'title'    => 'Transports en commun et mobilités douces : où va le réseau mulhousien d’ici 2030 ?',
			'category' => 'decrypter',
			'excerpt'  => 'Alors que le plan de déplacement urbain fait débat dans l’agglomération, nous avons épluché les données de fréquentation du tramway et les futurs aménagements cyclables.',
			'content'  => '<p class="has-large-font-size">Entre extensions de pistes cyclables et cadencement des lignes Soléa, les choix d’investissements soulèvent des questions cruciales pour le quotidien des habitants.</p><p>Dans cette enquête approfondie, nous revenons sur les investissements prévus par la collectivité, les zones blanches encore mal desservies dans les quartiers périphériques, et les solutions pragmatiques inspirées des villes voisines rhénanes.</p>',
			'image'    => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1200&q=80',
		),
		array(
			'title'    => 'Tribune : « La place Franklin mérite une véritable concertation avec ses résidents »',
			'category' => 'debattre',
			'excerpt'  => 'Point de vue de Karim B., commerçant et membre du collectif des habitants de Franklin, qui appelle à repenser les usages et la sécurité par le dialogue.',
			'content'  => '<p class="has-large-font-size">On ne transforme pas un quartier historique à coups de décisions unilatérales prises depuis un bureau fermé.</p><p>La vie de quartier repose d’abord sur la confiance et l’écoute mutuelle. C’est pourquoi nous proposons l’organisation d’ateliers citoyens ouverts chaque trimestre pour coconstruire les futurs aménagements urbains avec ceux qui y vivent chaque jour.</p>',
			'image'    => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=1200&q=80',
		),
		array(
			'title'    => 'Végétalisation participative : quand les habitants des Coteaux réinventent leurs cours d’immeubles',
			'category' => 'agir',
			'excerpt'  => 'Retour sur une opération citoyenne exemplaire menée samedi dernier par une trentaine de bénévoles et familles du quartier.',
			'content'  => '<p class="has-large-font-size">Pelles et terreau en main, les résidents ont transformé 400 m² de dalles de béton en îlots de fraîcheur et potagers partagés.</p><p>Une dynamique locale forte qui prouve que l’action citoyenne à l’échelle d’un îlot d’immeubles crée du lien intergénérationnel et répond directement aux défis climatiques urbains.</p>',
			'image'    => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=1200&q=80',
		),
		array(
			'title'    => 'Portrait : Sophie, artisane céramiste qui fait rayonner le savoir-faire textile et design à la Fonderie',
			'category' => 'valoriser',
			'excerpt'  => 'Installée dans les ateliers partagés de la Fonderie, elle réinterprète les motifs historiques de l’impression textile mulhousienne avec une approche contemporaine.',
			'content'  => '<p class="has-large-font-size">Mulhouse a une âme industrielle et créative unique en Alsace qu’il faut chérir et soutenir.</p><p>Dans cet entretien passionnant, Sophie nous ouvre les portes de son atelier et partage son amour pour l’héritage ouvrier et artistique de la ville du Bollwerk.</p>',
			'image'    => 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=1200&q=80',
		),
		array(
			'title'    => 'Commerces de proximité : le grand défi de l’attractivité du centre historique',
			'category' => 'decrypter',
			'excerpt'  => 'Loyer, stationnement, concurrence des zones commerciales : analyse chiffrée des forces et des fragilités des boutiques indépendantes de la rue du Sauvage et de la place de la Réunion.',
			'content'  => '<p class="has-large-font-size">Comment redonner envie de flâner et de consommer au cœur de la ville ?</p><p>Nous avons croisé les données de vacance commerciale de ces cinq dernières années avec les témoignages d’une dizaine de commerçants indépendants pour comprendre les leviers concrets de relance.</p>',
			'image'    => 'https://images.unsplash.com/photo-1513151233558-d860c5398176?w=1200&q=80',
		),
	);

	foreach ( $demo_posts as $post_data ) {
		$cat_id = isset( $cat_ids[ $post_data['category'] ] ) ? array( $cat_ids[ $post_data['category'] ] ) : array();
		
		$post_id = wp_insert_post( array(
			'post_title'    => $post_data['title'],
			'post_content'  => $post_data['content'],
			'post_excerpt'  => $post_data['excerpt'],
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => $cat_id,
		) );
	}

	update_option( 'mac_demo_content_installed', true );
}
add_action( 'init', 'mac_seed_demo_content' );
