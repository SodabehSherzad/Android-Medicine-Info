// Store Class: Handles Storage
class Store {

    static getFavorites(origin) {
        let favorites;
        if(localStorage.getItem(origin) === null) {
        favorites = [];
        } else {
        favorites = JSON.parse(localStorage.getItem(origin));
        }

        document.cookie = origin + "=" + favorites.join(",");
        return favorites;
    }

    static addFavorite(origin, id) {
        const favorites = Store.getFavorites(origin);
        favorites.push(id);
        localStorage.setItem(origin, JSON.stringify(favorites));
    }

    static removeFavorite(origin, id) {
        const favorites = Store.getFavorites(origin);

        favorites.forEach((favorite, index) => {
        if(favorite === id) {
            favorites.splice(index, 1);
        }
        });

        localStorage.setItem(origin, JSON.stringify(favorites));
    }
    }