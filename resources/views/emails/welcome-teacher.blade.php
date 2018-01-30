@component('mail::message')
    

# Bienvenue sur la plateforme Clairefontaine ENT

**{{ $teacher->firstname }}**, nous sommes heureux de vous informer que votre
compte à bien été crée. Cette inscription vous donne droit à un compte
sur la plateforme *Clairefontaine ENT*.

## A quoi sert Clairefontaine ENT ?

ENT est l'acronyme de Environnement Numérique de Travail. Clairefontaine ENT
est votre nouvel outils de travail. Grâce à cette plateforme vous pourrez :
- Consulter votre planning
- Plannifier des devoirs
- Enregistrer des notes et les commenter
- Commenter les bulletins et bien plus encore !


Vous trouverez ci-dessous vous identifiants de connexion :

- Login : {{ $teacher->email }}

- Mot de passe : {{ $password  }}

Conservez-les précieusement car **ils ne vous seront pas renvoyer**.

@component('mail::button', ['url' => route('home') ])


Aller sur Clairefontaine ENT


@endcomponent

Merci ,<br>

L'équipe {{ config('app.name') }}


@component('mail::subcopy')
    **Ce mail est issue d'un envoi automatique. Veuillez ne pas y répondre.**
@endcomponent


@endcomponent
