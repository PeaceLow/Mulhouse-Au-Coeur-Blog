# Mulhouse au Cœur — Blog & Média Citoyen

> Plateforme éditoriale et média citoyen local pour observer, comprendre, débattre et valoriser la vie mulhousienne.

---

## 📌 Présentation du Projet

Porté par le mouvement **Mulhouse au Cœur**, ce projet a pour objectif de pérenniser et transformer l’engagement local à travers un **média citoyen accessible, vivant et constructif**, affranchi des codes partisans traditionnels.

Le média s’organise autour de **5 piliers éditoriaux** :
- **DÉCRYPTER** : Analyses, données locales, dossiers de fond et décryptage des décisions publiques.
- **DÉBATTRE** : Tribunes, opinions citoyennes, interviews et confrontations d'idées.
- **AGIR** : Initiatives citoyennes, mobilisations, projets et événements locaux.
- **VALORISER** : Portraits d’acteurs mulhousiens (habitants, assos, créateurs, commerçants).
- **NOUS CONTACTER** : Espace d'échange et de proposition de sujets/contributions par les citoyens.

---

## 🛠️ Choix Technologique

Après analyse des besoins d'autonomie éditoriale, de budget et de pérennité, la solution retenue est **WordPress** avec une architecture moderne basée sur **l'éditeur de blocs natif (Gutenberg / FSE)**.

### Pourquoi ce choix ?
1. **Autonomie totale des contributeurs** : Prise en main immédiate pour des rédacteurs non-techniques sans dépendre d'un prestataire pour chaque publication.
2. **Performance & Légèreté** : Utilisation d'un thème sur-mesure épuré sans page builder lourd (pas d'Elementor/Divi), garantissant un temps de chargement optimal (Core Web Vitals) et un excellent SEO.
3. **Coûts maîtrisés** : Hébergement souverain accessible (~60–100 €/an) sans frais de licence mensuelle par rédacteur.
4. **Écosystème pérenne** : Évolution facilitée (newsletter, soumission de contributions citoyennes, gestion multi-auteurs, conformité RGPD).

Retrouvez l'analyse comparative détaillée dans [`docs/cadrage-et-recommandations.md`](docs/cadrage-et-recommandations.md).

---

## 📁 Structure du Répertoire

```text
Mulhouse_Au_Coeur/
├── docs/                             # Documentation, spécifications et cadrage
│   ├── cadrage-et-recommandations.md # Note de cadrage et comparatif technique
│   └── guide-contributeur.md         # Guide de rédaction et bonnes pratiques (à venir)
├── assets/                           # Éléments graphiques, charte et médias
│   ├── brand/                        # Logos, typographies, palettes de couleurs
│   └── mockups/                      # Wireframes et maquettes d'interface
├── theme/                            # Thème WordPress sur-mesure (Gutenberg/FSE)
│   ├── templates/                    # Gabarits de pages (Accueil, Article, Archives)
│   ├── parts/                        # Éléments réutilisables (Header, Footer, Navigation)
│   ├── patterns/                     # Compositions de blocs éditoriaux
│   └── theme.json                    # Configuration des styles et de la charte graphique
├── Demande.md                        # Cahier des charges initial
└── README.md                         # Ce fichier
```

---

## 💻 Tester le Rendu en Local (sans PHP ni Docker)

Le projet utilise **WordPress Playground (WASM)**. Vous pouvez tester le site instantanément avec une simple commande Node :

```bash
npm run dev
```

- **Site public** : [http://127.0.0.1:9400](http://127.0.0.1:9400)
- **Tableau de bord WordPress** : [http://127.0.0.1:9400/wp-admin](http://127.0.0.1:9400/wp-admin) *(connexion admin automatique)*

---

- [x] **Phase 0 : Cadrage & Choix Technique**
  - Analyse du besoin et de la charte éditoriale
  - Choix de la stack (WordPress Gutenberg moderne)
  - Structuration du dépôt et note de synthèse
- [ ] **Phase 1 : Design & UX**
  - Déclinaison de la charte graphique *Mulhouse au Cœur*
  - Maquettage des 5 gabarits clés (Accueil, Article, Rubriques, Contact/Proposition)
- [ ] **Phase 2 : Développement du Thème & Intégration**
  - Mise en place du thème `theme.json` et des blocs personnalisés
  - Configuration des taxonomies (les 5 verbes éditoriaux)
  - Intégration du formulaire de proposition citoyenne & connecteur newsletter
- [ ] **Phase 3 : Tests, SEO & Recettage**
  - Audit d'accessibilité et de performance mobile
  - Balisage SEO local et métadonnées sociales (OpenGraph)
- [ ] **Phase 4 : Déploiement & Formation**
  - Configuration de l'hébergement de production et certificats SSL
  - Atelier de formation de l'équipe éditoriale

---

## 👥 Équipe & Gouvernance

- **Initiative** : Mouvement citoyen Mulhouse au Cœur
- **Licence & Propriété** : Tous droits réservés à l'association Mulhouse au Cœur
