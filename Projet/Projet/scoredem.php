<?php  
function scoring_demandeur($comp_offre, $comp_demandeur, $experience_offre, $experience_demandeur, $diplome_offre, $diplome_demandeur)
{

    $comp_offre_arr=(explode("/",$comp_offre)); //retourner un tableu de compétences
    $comp_demandeur_arr=(explode("/",$comp_demandeur));//retourner un tableu de compétences
    $score = 0;

    // 5 pts pour chaque competence
    foreach ($comp_offre_arr as $comp) {
        if (in_array(strtolower($comp), array_map('strtolower',  $comp_demandeur_arr))) {
            $score += 5;
        }
    }

    // 2 pts pour chaque année
    if ($experience_demandeur >= $experience_offre) {
        $score += (2 * $experience_demandeur);
    }

    if (strtolower($diplome_demandeur) != strtolower($diplome_offre)) {
        $score = 0;
    }

    return $score;
}


?>