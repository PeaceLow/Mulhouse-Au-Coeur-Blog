# Contexte et Recommandation Technique — Blog Citoyen Mulhouse au Cœur

## 1. Contexte et Vision du Projet

### 1.1 Genèse
Porté par le mouvement **Mulhouse au Cœur**, ce projet marque une transition entre une expérience électorale et une démarche pérenne d'engagement local. L'ambition est de créer un **média / blog citoyen** au service des Mulhousiens, sans adopter les codes convenus d'un parti ou d'un site politique traditionnel.

### 1.2 Valeurs & Positionnement
- **Ancrage local** : Attachement fort au territoire mulhousien et à ses habitants.
- **Participation & démocratie locale** : Donner la parole, favoriser le débat pluriel et l'esprit critique.
- **Mise en valeur** : Valoriser les initiatives de quartier, les acteurs culturels, associatifs et économiques.
- **Ton éditorial** : Direct, vivant, accessible, positif, constructif et parfois impertinent.

---

## 2. Architecture Éditoriale & Fonctionnelle

Le site est articulé autour de **5 piliers majeurs** :

| Rubrique | Objectif éditorial | Exemples de formats |
| :--- | :--- | :--- |
| **DÉCRYPTER** | Comprendre les enjeux, décisions publiques et données locales | Analyses, dossiers thématiques, infographies, synthèses |
| **DÉBATTRE** | Confrontation d'idées, tribunes et pluralité d'opinions | Interviews, tribunes citoyennes, tables rondes |
| **AGIR** | Passer à l'action et s'investir dans la cité | Annonces d'initiatives, appels à projets, événements locaux |
| **VALORISER** | Lumière sur ceux qui font vivre Mulhouse | Portraits d'habitants, focus associations, artistes, commerçants |
| **NOUS CONTACTER** | Passerelle citoyenne active | Formulaire de contact, soumission de contributions / sujets |

### Besoins fonctionnels clés :
1. **Édition collaborative** : Gestion de multiples auteurs et contributeurs avec des droits adaptés (administrateur, éditeur, auteur).
2. **Page d'accueil modulaire** : Mise en avant d'articles "À la une", mise en valeur dynamique des 5 rubriques, présentation synthétique de la démarche.
3. **Médias riches** : Intégration fluide d'images optimisées, vidéos, documents PDF téléchargeables.
4. **Engagement** : Partage sur réseaux sociaux, formulaire de proposition de sujet avec dépôt de document, inscription newsletter (ex. Brevo / Mailchimp).
5. **SEO & Performance** : Référencement local optimisé, balisage Schema.org, responsive mobile-first irréprochable.

---

## 3. Analyse Comparative & Choix de la Solution Technique

### 3.1 Comparatif des solutions

| Critère | **WordPress (Recommandé)** | **Ghost** | **Headless / Jamstack (Astro + Strapi)** | **SaaS (Webflow / Squarespace)** |
| :--- | :--- | :--- | :--- | :--- |
| **Simplicité pour non-techniciens** | **Excellente** (éditeur Gutenberg standardisé, familier) | Très bonne (interface épurée) | Moyenne (deux consoles, dev requis pour changer la structure) | Très bonne mais interface de conception complexe |
| **Autonomie post-livraison** | **Totale** (pas de dépendance prestataire pour les contenus et pages) | Forte mais personnalisation des templates plus rigide | Faible (maintenance front/back permanente) | Forte pour le design, limitée sur la gestion multi-auteurs complexe |
| **Coût récurrent** | **Très faible** (~5 à 10 €/mois pour hébergement standard) | Moyen (~15 à 30 €/mois sur Ghost Pro) | Moyen à élevé (hébergement front + CMS Cloud) | Élevé (~25 à 50 €/mois + coût par siège contributeur) |
| **Gestion multi-auteurs & droits** | **Native et granulaire** | Native (très bon pour newsletters) | À configurer entièrement | Limitée ou payante au compte-goutte |
| **Écosystème & évolutivité** | **Quasi-illimité** (formulaires, SEO, newsletter, extensions) | Spécialisé newsletter/abonnements | Sur-mesure mais coûteux en dev | Limité aux intégrations propriétaires |
| **Sécurité & Maintenance** | Bonne **à condition d'appliquer les bonnes pratiques** (mises à jour, 2FA, backups) | Excellente (très peu de surface d'attaque) | Excellente pour le front statique | Gérée par la plateforme |

### 3.2 Pourquoi WordPress est le choix le plus fiable et pragmatique
1. **Autonomie réelle de l'équipe** : L'équipe de rédaction n'aura pas besoin d'un développeur pour créer un nouvel article, intégrer des galeries ou agencer les blocs de la page d'accueil.
2. **Pérennité & Propriété des données** : Le site et sa base de données restent la propriété totale de l'association, hébergeables chez n'importe quel prestataire souverain européen (Infomaniak, O2Switch, OVH).
3. **Architecture moderne sans "usine à gaz"** : 
   - Utilisation de l'approche **Full Site Editing (FSE) / Gutenberg natif** avec un thème sur-mesure léger (ou basé sur un starter theme épuré comme *Frost* ou *GeneratePress*).
   - Zéro constructeur de page lourd (pas d'Elementor ou Divi) pour garantir un temps de chargement ultra-rapide et un code propre.
   - Sélection stricte de 4 à 5 extensions éprouvées (SEO, formulaires sécurisés, cache/sécurité, intégration newsletter).

---

## 4. Estimation Budgétaire & Coûts Récurrents

### 4.1 Coûts d'infrastructure récurrents (à charge de l'association)
- **Nom de domaine** (.fr ou .alsace) : ~8 à 15 € HT / an.
- **Hébergement web haute performance** (ex: Infomaniak Web + Mail, O2Switch) : ~60 à 100 € HT / an (inclut certificats SSL, sauvegardes quotidiennes, boîtes mails professionnelles).
- **Service d'envoi Newsletter** (ex: Brevo / Mailjet) : **Gratuit** jusqu'à 300 emails/jour, puis ~19 €/mois selon le volume.
- **Total récurrent estimé** : **~70 à 120 € HT / an**.

### 4.2 Périmètre de réalisation (Recommandation d'étapes)
1. **Étape 1 : Cadrage & Maquettage UX/UI** :
   - Déclinaison de la charte *Mulhouse au Cœur* pour le média.
   - Wireframes & maquettes des gabarits clés (Accueil, Article, Rubrique, Contact/Contribution).
2. **Étape 2 : Développement & Intégration** :
   - Configuration WordPress sécurisé, base de données, SSL.
   - Développement du thème sur-mesure / blocs éditoriaux personnalisés.
   - Configuration des 5 verbes éditoriaux (taxonomies/catégories) et des métadonnées auteurs.
   - Formulaire de proposition de sujets et passerelle newsletter.
3. **Étape 3 : Recettage & Mise en ligne** :
   - Tests responsive, performances (Google PageSpeed), sécurité et RGPD.
   - Pointage DNS et mise en production.
4. **Étape 4 : Transmission & Autonomie** :
   - Formation de l'équipe (1 session visio + guide de prise en main au format PDF/Markdown).
   - Accompagnement / garantie de bon fonctionnement.
