<?php

namespace App\Entity\Enum;

enum Speciality: string
{
    case SoinsGeneraux = 'soins_generaux'; // soins de base, nettoyage, observation
    case SoinsVeterinaires = 'soins_veterinaires'; // assistance aux vétérinaires
    case NutritionTherapeutique = 'nutrition_therapeutique'; // alimentation spécifique liée à un traitement
    case Réhabilitation = 'rehabilitation'; // récupération post-traumatique ou post-opératoire
    case GestionMédicaments = 'gestion_medicaments'; // préparation et administration de traitements
    case SuiviComportemental = 'suivi_comportemental'; // observation de changements liés à la santé
    case PremiersSecours = 'premiers_secours'; // interventions d'urgence avant le vétérinaire
    case SoinsAnimauxÂgés = 'soins_animaux_ages'; // prise en charge spécifique des animaux vieillissants
    case HygièneEtPrévention = 'hygiene_et_prevention'; // désinfection, prévention des maladies
    case SoinsDentaires = 'soins_dentaires'; // hygiène et contrôle bucco-dentaire
    case SoinsPostOpératoires = 'soins_post_operatoires'; // surveillance après une chirurgie
}