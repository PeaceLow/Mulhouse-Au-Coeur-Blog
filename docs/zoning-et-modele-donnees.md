# Spécifications Fonctionnelles : Zoning & Modèle de Données

Ce document définit l'architecture de l'information, le zoning des gabarits clés et le modèle de données WordPress pour le média citoyen **Mulhouse au Cœur**.

---

## 1. Modèle de Données WordPress

Pour répondre à la fois à la simplicité d'administration et à la richesse des contenus, nous structurons les contenus en catégories et métadonnées claires.

### 1.1 Catégories Principales (Les 5 Verbes Éditoriaux)
Chaque article est obligatoirement rattaché à une catégorie principale :

| Slug / Identifiant | Libellé affiché | Rôle éditorial | Couleur d'accent suggérée |
| :--- | :--- | :--- | :--- |
| `decrypter` | **DÉCRYPTER** | Comprendre les décisions, dossiers de fond, chiffres et analyses locales | Bleu profond / Marine |
| `debattre` | **DÉBATTRE** | Tribunes citoyennes, interviews croisées, opinions et confrontations d'idées | Terracotta / Ocre |
| `agir` | **AGIR** | Initiatives concrètes, événements, mobilisations de quartier, propositions | Vert émeraude |
| `valoriser` | **VALORISER** | Portraits de Mulhousiens (habitants, assos, créateurs, commerçants) | Jaune chaleureux / Ambre |
| `contact` | **NOUS CONTACTER** | Page d'interaction & formulaire de contribution citoyenne | Neutre foncé |

### 1.2 Étiquettes Transversales (Tags)
Deux axes de filtrage complémentaires pour la recherche et les articles connexes :

1. **Axe Géographique (Quartiers de Mulhouse)** :
   - `Centre-Ville`, `Rebberg`, `Bourtzwiller`, `Coteaux`, `Drouot`, `Dornach`, `Franklin-Fridolin`, `Fonderie`, `Doller`, `Vauban`.
2. **Axe Thématique** :
   - `Mobilité & Transports`, `Écologie & Espaces Verts`, `Économie & Commerce`, `Jeunesse & Éducation`, `Culture & Patrimoine`, `Vie associative`.

### 1.3 Attributs & Métadonnées d'un Article
* **Titre principal**
* **Chapô (Extrait)** : 2 à 3 lignes résumant l'angle de l'article
* **Image mise en avant** (avec crédit photo obligatoire)
* **Temps de lecture estimé** (calculé automatiquement ou saisi)
* **Profil Contributeur / Auteur** :
  * Auteur interne (équipe de rédaction)
  * Contributeur externe citoyen (Nom, prénom, qualité / quartier de l'auteur invité)
* **Pièce jointe / Document source** (optionnel : PDF téléchargeable d'un rapport ou d'une délibération)

---

## 2. Zoning Détaillé des Pages Clés

### 2.1 Page d'Accueil (`front-page`)
L'objectif est d'éviter le format "site vitrine statique" pour donner l'impression immédiate d'un média vivant et dynamique.

```text
+-----------------------------------------------------------------------------------+
| [HEADER] Logo Mulhouse au Cœur | DÉCRYPTER | DÉBATTRE | AGIR | VALORISER | [PROPOSER UN SUJET] |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [BLOC HERO - À LA UNE] (Grille asymétrique)                                      |
|  +-----------------------------------------+  +---------------------------------+  |
|  | GRAND ARTICLE PRINCIPAL DU MOMENT       |  | 2 ARTICLES SECONDAIRES EN AVANT |  |
|  | - Badge catégorie (ex: DÉCRYPTER)       |  | Article 1 : DÉBATTRE            |  |
|  | - Grande photo de couverture            |  | Article 2 : VALORISER           |  |
|  | - Titre fort + Chapô + Temps de lecture |  |                                 |  |
|  +-----------------------------------------+  +---------------------------------+  |
|                                                                                   |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [SECTION DÉCRYPTER & DÉBATTRE] (2 colonnes)                                      |
|  +------------------------------------+  +------------------------------------+  |
|  | DÉCRYPTER                          |  | DÉBATTRE                           |  |
|  | [Carte article 1 avec données]     |  | [Tribune avec photo de l'auteur]   |  |
|  | [Carte article 2]                  |  | [Interview / Point de vue]         |  |
|  | > Tous les décryptages             |  | > Toutes les tribunes              |  |
|  +------------------------------------+  +------------------------------------+  |
|                                                                                   |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [BANNIÈRE D'ENGAGEMENT CITOYEN]                                                  |
|  "Vous observez quelque chose dans votre quartier ? Vous avez une idée pour la ville ?" |
|  [Bouton : Proposer un sujet ou une tribune]                                      |
|                                                                                   |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [SECTION AGIR & VALORISER] (Grille 3 ou 4 colonnes)                              |
|  +------------------+  +------------------+  +------------------+  +------------+ |
|  | Portrait asso    |  | Initiative verte |  | Événement local  |  | Artiste    | |
|  | (VALORISER)      |  | (AGIR)           |  | (AGIR)           |  | (VALORISER)| |
|  +------------------+  +------------------+  +------------------+  +------------+ |
|                                                                                   |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [ENCART NEWSLETTER]                                                              |
|  "Recevez l'essentiel de l'actualité citoyenne mulhousienne chaque semaine"       |
|  [Champ : Votre adresse email] [Bouton : M'inscrire]                              |
|                                                                                   |
+-----------------------------------------------------------------------------------+
| [FOOTER] À propos de la démarche | Les 5 verbes | Mentions légales | Réseaux      |
+-----------------------------------------------------------------------------------+
```

---

### 2.2 Gabarit Page Article (`single`)

1. **Fil d'Ariane (Breadcrumb)** : Accueil > [Catégorie] > Titre
2. **En-tête de lecture** :
   - Badge de catégorie cliquable
   - Titre niveau 1 percutant
   - Chapô d'introduction (style éditorial typographique valorisé)
   - Barre de métadonnées : Date, temps de lecture, nom de l'auteur, boutons de partage rapide (X/Twitter, Facebook, WhatsApp, Copier lien)
3. **Image principale légendée** (largeur étendue)
4. **Corps de l'article** :
   - Typographie aérée, lisibilité mobile irréprochable
   - Blocs de citation grand format ("Pull quotes")
   - Encart "Données clés" ou "En savoir plus"
   - Téléchargement d'un document éventuel (bouton stylisé)
5. **Encart Auteur / Contributeur** :
   - Photo/Avatar de l'auteur
   - Courte bio (ex : *"Habitant du quartier Franklin, engagé pour les mobilités douces"*)
6. **Recommandations de lecture** :
   - 3 articles en lien avec le sujet ou le même quartier

---

### 2.3 Page "Nous Contacter & Proposer un Sujet" (`page-contact`)

Un formulaire simple avec deux modes commutables par un sélecteur :
1. **Mode Message simple** : Nom, email, message (pour joindre l'équipe).
2. **Mode Proposition citoyenne** :
   - Type de contribution : *Alerte / info de quartier*, *Tribune / avis*, *Initiative à valoriser*.
   - Titre ou résumé de l'idée.
   - Détail / texte.
   - Quartier concerné (menu déroulant).
   - Dépôt de fichier (photo ou document PDF, max 10 Mo).
   - Coordonnées de contact.
