<?php

namespace App\Services;

class LangService
{
    public function EnglishWords()
    {
        $translations['indicate-your']['en'] = "Indicate your dates and times";
        $translations['brunch']['en'] = "Brunch";
        $translations['select-product']['en'] = "Select the products";
        $translations['dont-miss']['en'] = "Don't miss...";
        $translations['reserver']['en'] = "Reserver";
        $translations['select-brunch']['en'] = "Selected brunch";
        $translations['prenom']['en'] = "First name";
        $translations['perrier']['en'] = "Perrier";
        $translations['nam-de-enterprise']['en'] = "Company name";
        $translations['works-with-selectes']['en'] = "Works with selects";
        $translations['numero-de-voie']['en'] = "Lane number and street standard";
        $translations['appartnent']['en'] = "Appartement or";
        $translations['code-postal']['en'] = "Postal code";
        $translations['ville']['en'] = "City";
        $translations['telephone']['en'] = "Phone";
        $translations['addresse-de']['en'] = "Adresse de messagerie";
        $translations['reglement']['en'] = "Reglement";
        $translations['stripe']['en'] = "Stripe";
        $translations['sous-total']['en'] = "Under total";
        $translations['total']['en'] = "Total";
        $translations['payer']['en'] = "Payer";

        return $translations;
    }


    public function FranceWords()
    {
        $translations['indicate-your']['fr'] = "Indiques vos dates et holralres";
        $translations['brunch']['fr'] = "Brunch";
        $translations['select-product']['fr'] = "Sélectionnez les produits";
        $translations['dont-miss']['fr'] = "Ne manquez pas...";
        $translations['reserver']['fr'] = "Réserves";
        $translations['select-brunch']['fr'] = "Brunch sélectionné";
        $translations['prenom']['fr'] = "Prenom";
        $translations['perrier']['fr'] = "Perrier";
        $translations['nam-de-enterprise']['fr'] = "Nam de l'enterprise";
        $translations['works-with-selectes']['fr'] = "Fonctionne avec les sélections";
        $translations['numero-de-voie']['fr'] = "Numero de voie et norm de rue";
        $translations['appartnent']['fr'] = "Appartement ou";
        $translations['code-postal']['fr'] = "Code postal";
        $translations['ville']['fr'] = "Ville";
        $translations['telephone']['fr'] = "Telephone";
        $translations['addresse-de']['fr'] = "Email";
        $translations['reglement']['fr'] = "Règlement";
        $translations['stripe']['fr'] = "Stripe";
        $translations['sous-total']['fr'] = "Sous total";
        $translations['total']['fr'] = "Total";
        $translations['payer']['fr'] = "Payeur";

        return $translations;
    }
}
