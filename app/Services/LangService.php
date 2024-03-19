<?php

namespace App\Services;

class LangService
{
    public function englishWords(&$translations)
    {
        $translations['indicate-your']['en'] = "Indicate your dates and times";
        $translations['choise1']['en'] = 'Choisissez une date et une heure de visite';
        $translations['choise2']['en'] = 'Choisissez une date et une heure de visite';
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
        $translations['promocode']['en'] = "Promocode";
        $translations['apply']['en'] = "Apply";
        $translations['noAppointment']['en'] = "No appointment on this day";

        $translations['thanks']['en'] = "Thanks !";
        $translations['received-reservation']['en'] = "We have received your reservation to visit our cellars";
        $translations['invite-meet-us']['en'] = "We therefore invite you to meet us on";
        $translations['see-you-soon']['en'] = "You will receive a confirmation email today with the details of your order. See you soon";
    }


    public function franceWords(&$translations)
    {
        $translations['indicate-your']['fr'] = "Indiques vos dates et holralres";
        $translations['choise1']['fr'] = 'Choisissez une date et une heure de visite';
        $translations['choise2']['fr'] = 'Choisissez une date et une heure de visite';
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
        $translations['promocode']['fr'] = "Code promo";
        $translations['apply']['fr'] = "Appliquer";
        $translations['noAppointment']['fr'] = "pas de rendez-vous ce jour";

        $translations['thanks']['fr'] = "Merci !";
        $translations['received-reservation']['fr'] = "Nous avons blen receptionee votre reservation pour visitier nos caves";
        $translations['invite-meet-us']['fr'] = "Nous vous donnons donc rendez vous le";
        $translations['see-you-soon']['fr'] = "Vous allez recevoir ce jour un mail de confirmation avec le detail de votre commande. A bientot";
    }
}
