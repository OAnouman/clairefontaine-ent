@component('mail::message')


# Bienvenue sur la plateforme Clairefontaine ENT

Nous sommes heureux de vous informer que l'inscription de
*{{ $student->firstname . ' ' . $student->lastname }}* à bien été effectuée.
Cette inscription vous donne droit à un compte sur la plateforme
Clairefontaine ENT pour toute la durée de sa scolarité à l'*Ecole Internationale
Clairefontaine*.

Vous trouverez ci-dessous vos identifiants de connexion :

- Login : {{ $student->username }}

- Mot de passe : {{ $password  }}

Conservez-les précieusement.

@component('mail::button', ['url' => route('login') ])


Aller sur Clairefontaine ENT


@endcomponent

Merci ,<br>

L'équipe {{ config('app.name') }}

@component('mail::subcopy')
    **Ce mail est issue d'un envoi automatique. Veuillez ne pas y répondre.**
@endcomponent


@endcomponent
