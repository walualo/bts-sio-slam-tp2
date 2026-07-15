const boutons = document.querySelectorAll(".btn-supprimer");

const zoneMessage = document.querySelector("#message");

    boutons.forEach((bouton) => {
        bouton.addEventListener("click", async () => {

        const id = bouton.dataset.id;

        const confirmation = confirm(
        "Voulez-vous réellement supprimer cet étudiant ?"
        );
    if (!confirmation) {
        return;
    }

    const donnees = new FormData();
        donnees.append("id", id);
    try {

    const reponse = await fetch("supprimer.php", {
        method: "POST",
        body: donnees
    });

    const resultat = await reponse.json();
        zoneMessage.textContent = resultat.message;

    if (resultat.succes) {
        const ligne = document.querySelector(
            `#etudiant-${id}`
        );
        ligne.remove();
    }

    } catch (erreur) {
        zoneMessage.textContent =
            "Le serveur n'a pas pu être contacté.";
        }
    });
});