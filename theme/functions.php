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
 * Configuration initiale du site
 */
function mac_setup_site() {
	if ( get_option( 'mac_site_configured' ) ) {
		return;
	}

	update_option( 'blogname', 'Mulhouse au Cœur' );
	update_option( 'blogdescription', 'Média citoyen libre & participatif' );
	update_option( 'timezone_string', 'Europe/Paris' );
	update_option( 'date_format', 'j F Y' );
	update_option( 'WPLANG', 'fr_FR' );

	update_option( 'mac_site_configured', true );
}
add_action( 'init', 'mac_setup_site', 5 );

/**
 * Télécharge une image depuis une URL et l'attache à un post
 */
function mac_sideload_image( $url, $post_id, $description = '' ) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		return false;
	}

	$file_array = array(
		'name'     => sanitize_file_name( basename( parse_url( $url, PHP_URL_PATH ) ) ) . '.jpg',
		'tmp_name' => $tmp,
	);

	$attachment_id = media_handle_sideload( $file_array, $post_id, $description );
	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		return false;
	}

	return $attachment_id;
}

/**
 * Initialisation automatique des catégories et articles de démonstration
 */
function mac_seed_demo_content() {
	// Ne pas réexécuter si le contenu de démo a déjà été créé (version 3)
	if ( get_option( 'mac_demo_content_v3' ) ) {
		return;
	}

	// Supprimer l'ancien contenu de démo et le post par défaut "Hello World"
	$old_posts = get_posts( array(
		'numberposts' => -1,
		'post_status' => 'any',
	) );
	foreach ( $old_posts as $old_post ) {
		wp_delete_post( $old_post->ID, true );
	}

	// Supprimer l'ancienne page d'exemple
	$old_pages = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'page',
		'post_status' => 'any',
	) );
	foreach ( $old_pages as $old_page ) {
		wp_delete_post( $old_page->ID, true );
	}

	// 1. Création des catégories éditoriales officielles
	$categories = array(
		'decrypter' => array(
			'name'        => 'Décrypter',
			'description' => 'Comprendre les enjeux mulhousiens : actualité locale, données, décisions publiques, dossiers de fond et décryptages.',
		),
		'debattre'  => array(
			'name'        => 'Débattre',
			'description' => 'Tribunes citoyennes, interviews croisées, opinions et confrontations de points de vue sur l\'avenir de Mulhouse.',
		),
		'agir'      => array(
			'name'        => 'Agir',
			'description' => 'Initiatives concrètes, événements, mobilisations de quartier et propositions citoyennes pour Mulhouse.',
		),
		'valoriser' => array(
			'name'        => 'Valoriser',
			'description' => 'Portraits de Mulhousiens : habitants, associations, créateurs, commerçants et acteurs culturels qui font vivre la ville.',
		),
	);

	// Supprimer la catégorie "Uncategorized"
	$default_cat = get_term_by( 'slug', 'uncategorized', 'category' );
	if ( $default_cat ) {
		wp_delete_term( $default_cat->term_id, 'category' );
	}

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

	// 2. Création des articles avec images réalistes
	$demo_posts = array(
		array(
			'title'    => 'Transports en commun et mobilités douces : où va le réseau mulhousien d'ici 2030 ?',
			'category' => 'decrypter',
			'excerpt'  => 'Alors que le plan de déplacement urbain fait débat dans l'agglomération, nous avons épluché les données de fréquentation du tramway et les futurs aménagements cyclables pour comprendre les enjeux.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Entre extensions de pistes cyclables et cadencement des lignes Soléa, les choix d'investissements soulèvent des questions cruciales pour le quotidien de dizaines de milliers d'habitants.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Dans cette enquête approfondie, nous revenons sur les investissements prévus par la collectivité, les zones blanches encore mal desservies dans les quartiers périphériques, et les solutions pragmatiques inspirées des villes voisines rhénanes comme Freiburg ou Bâle.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>« Le tramway est le colonne vertébrale de la mobilité mulhousienne, mais il ne suffit plus à répondre aux besoins des quartiers excentrés. »</p><cite>Un responsable des transports de l'agglomération</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p>Les chiffres parlent d'eux-mêmes : la fréquentation du tramway a augmenté de 12% en trois ans, tandis que le réseau cyclable ne couvre que 38% des axes principaux. La question du dernier kilomètre reste entière pour des quartiers comme Bourtzwiller ou les Coteaux.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1200&q=80',
			'date'     => '2026-09-26 10:00:00',
		),
		array(
			'title'    => 'Tribune : « La place Franklin mérite une véritable concertation avec ses résidents »',
			'category' => 'debattre',
			'excerpt'  => 'Point de vue de Karim B., commerçant et membre du collectif des habitants de Franklin, qui appelle à repenser les usages, la sécurité et l'aménagement urbain par le dialogue et non par le décret.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">On ne transforme pas un quartier historique à coups de décisions unilatérales prises depuis un bureau. Il est temps d'écouter ceux qui y vivent chaque jour.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>La vie de quartier repose d'abord sur la confiance et l'écoute mutuelle. C'est pourquoi nous proposons l'organisation d'ateliers citoyens ouverts chaque trimestre pour coconstruire les futurs aménagements urbains avec les habitants, les commerçants et les associations de proximité.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Le dernier réaménagement de la place a été pensé sans aucune consultation préalable des riverains. Résultat ? Des bancs publics tournés contre les façades, un éclairage insuffisant le soir, et un espace vert réduit de moitié. Des choix incompréhensibles pour ceux qui connaissent le terrain.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=1200&q=80',
			'date'     => '2026-09-25 14:30:00',
		),
		array(
			'title'    => 'Végétalisation participative : quand les habitants des Coteaux réinventent leurs cours d'immeubles',
			'category' => 'agir',
			'excerpt'  => 'Retour sur une opération citoyenne exemplaire menée samedi dernier par une trentaine de bénévoles et familles du quartier des Coteaux, pelles et terreau en main.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Pelles et terreau en main, les résidents ont transformé 400 m² de dalles de béton en îlots de fraîcheur et potagers partagés en l'espace d'un week-end.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Une dynamique locale forte qui prouve que l'action citoyenne à l'échelle d'un îlot d'immeubles crée du lien intergénérationnel et répond directement aux défis climatiques urbains. Les enfants ont participé aux plantations tandis que les anciens partageaient leurs connaissances en jardinage.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Ce projet, soutenu par le bailleur social Mulhouse Habitat et la Ville, a mobilisé trois associations locales et une vingtaine de familles. Il sera répliqué dans deux autres résidences du quartier d'ici l'automne.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=1200&q=80',
			'date'     => '2026-09-24 09:15:00',
		),
		array(
			'title'    => 'Portrait : Sophie, artisane céramiste qui fait rayonner le savoir-faire textile et design à la Fonderie',
			'category' => 'valoriser',
			'excerpt'  => 'Installée dans les ateliers partagés de la Fonderie, elle réinterprète les motifs historiques de l'impression textile mulhousienne avec une approche résolument contemporaine.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">« Mulhouse a une âme industrielle et créative unique en Alsace qu'il faut absolument chérir et soutenir. C'est cette âme qui m'a fait rester ici. »</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Dans cet entretien passionnant, Sophie nous ouvre les portes de son atelier baigné de lumière naturelle et partage son amour pour l'héritage ouvrier et artistique de la ville du Bollwerk. Ses pièces de céramique, ornées de motifs inspirés des archives de la Société Industrielle de Mulhouse, sont vendues dans toute l'Europe.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Avec trois autres artisans, elle organise des ateliers découverte chaque mercredi pour les jeunes du quartier. « Transmettre, c'est aussi créer du lien social » dit-elle en souriant.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=1200&q=80',
			'date'     => '2026-09-23 16:00:00',
		),
		array(
			'title'    => 'Commerces de proximité : le grand défi de l'attractivité du centre historique',
			'category' => 'decrypter',
			'excerpt'  => 'Loyer, stationnement, concurrence des zones commerciales périphériques : analyse chiffrée des forces et des fragilités des boutiques indépendantes de la rue du Sauvage et de la place de la Réunion.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Comment redonner envie de flâner et de consommer au cœur de la ville, entre les enseignes nationales et les vitrines vides ?</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Nous avons croisé les données de vacance commerciale de ces cinq dernières années avec les témoignages d'une dizaine de commerçants indépendants pour comprendre les leviers concrets de relance du centre-ville mulhousien.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Le taux de vacance commerciale atteint 18% dans certaines rues secondaires du centre, contre 8% il y a dix ans. Pourtant, des exemples de réussites existent : la rue de la Moselle, réaménagée il y a deux ans, a vu son taux d'occupation remonter à 95%.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1519999482648-25049ddd37b1?w=1200&q=80',
			'date'     => '2026-09-22 11:30:00',
		),
		array(
			'title'    => 'Le collectif « Mulhouse Respire » lance une cartographie participative de la qualité de l'air',
			'category' => 'agir',
			'excerpt'  => 'Équipés de micro-capteurs, des bénévoles arpentent les rues pour mesurer les niveaux de pollution quartier par quartier et alerter les décideurs avec des données concrètes.',
			'content'  => '<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Quand les citoyens se transforment en chercheurs pour défendre leur santé et celle de leurs enfants.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Le collectif « Mulhouse Respire » a distribué 50 micro-capteurs de particules fines à des volontaires répartis dans les quartiers les plus exposés : abords du périphérique, zones industrielles et axes de transit poids-lourds.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Les premières données, collectées sur trois mois, révèlent des pics de pollution préoccupants aux heures de pointe dans le quartier de la Doller et aux abords de la gare. Une carte interactive sera mise en ligne d'ici octobre.</p>
<!-- /wp:paragraph -->',
			'image'    => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&q=80',
			'date'     => '2026-09-21 08:45:00',
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
			'post_date'     => $post_data['date'],
		) );

		if ( $post_id && ! is_wp_error( $post_id ) && ! empty( $post_data['image'] ) ) {
			$attachment_id = mac_sideload_image( $post_data['image'], $post_id, $post_data['title'] );
			if ( $attachment_id ) {
				set_post_thumbnail( $post_id, $attachment_id );
			}
		}
	}

	// 3. Configurer la première catégorie comme catégorie par défaut
	if ( ! empty( $cat_ids['decrypter'] ) ) {
		update_option( 'default_category', $cat_ids['decrypter'] );
	}

	// 4. Configurer les permaliens
	update_option( 'permalink_structure', '/%postname%/' );
	flush_rewrite_rules();

	update_option( 'mac_demo_content_v3', true );
}
add_action( 'init', 'mac_seed_demo_content', 20 );
