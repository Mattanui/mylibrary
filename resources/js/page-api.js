const corpsTableau = document.querySelector('#livres-body');
const messageEtat = document.querySelector('#message-etat');

const formatPrix = new Intl.NumberFormat('fr-BE', { style: 'currency', currency: 'EUR' });

async function chargerLivres() {
    try {
        const reponse = await fetch('/api/livres', {
            headers: { Accept: 'application/json' },
        });

        if (!reponse.ok) {
            throw new Error('erreur HTTP ' + reponse.status);
        }

        const json = await reponse.json();
        afficherLivres(json.data);
    } catch (erreur) {
        messageEtat.textContent = 'Impossible de charger les livres (' + erreur.message + ').';
    }
}

function afficherLivres(livres) {
    if (livres.length === 0) {
        messageEtat.textContent = 'Aucun livre à afficher.';
        return;
    }

    for (const livre of livres) {
        const ligne = document.createElement('tr');
        ligne.className = 'border-b border-gray-200';

        const celluleImage = document.createElement('td');
        celluleImage.className = 'p-3';
        const image = document.createElement('img');
        image.src = livre.couverture;
        image.alt = 'Couverture de ' + livre.titre;
        image.className = 'h-20 w-auto border border-gray-300';
        celluleImage.appendChild(image);
        ligne.appendChild(celluleImage);

        ajouterCellule(ligne, livre.titre, 'p-3 font-semibold');
        ajouterCellule(ligne, livre.isbn, 'p-3');
        ajouterCellule(ligne, livre.categorie, 'p-3');
        ajouterCellule(ligne, formatPrix.format(livre.prix), 'p-3 text-right whitespace-nowrap');

        corpsTableau.appendChild(ligne);
    }

    messageEtat.textContent = livres.length + ' livre(s) chargé(s) depuis l\'API.';
}

function ajouterCellule(ligne, texte, classes) {
    const cellule = document.createElement('td');
    cellule.className = classes;
    cellule.textContent = texte;
    ligne.appendChild(cellule);
}

chargerLivres();
