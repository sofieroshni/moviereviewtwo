const API_KEY = 'api_key=4f1a67f6f2830323ea95668d0c42ef40';
const BASE_URL = 'https://api.themoviedb.org/3';  //  BASE_URL
const IMG_URL = 'https://image.tmdb.org/t/p/w500';
const searchURL = BASE_URL + '/search/movie?' + API_KEY;  //  søge-URL

const movieContainer = document.querySelector('#moviecontainer'); //min divboks hvor mine film skal afspilles
const searchForm = document.querySelector('#searchForm'); //searchform
const search = document.querySelector('#search'); //min search

const options = {
    method: 'GET',
    headers: {
        accept: 'application/json',
        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZjFhNjdmNmYyODMwMzIzZWE5NTY2OGQwYzQyZWY0MCIsIm5iZiI6MTcyNjkyODM0Ni43MTU5ODMsInN1YiI6IjY2ZWRkYTgzOTJkMzk2ODUzODNhZGIyYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Apl7CaEcZ4Potg5bPTYiSkZiS_ylMSEgc8HuIjdT86M'
    }
};
function getMovies(url) {
    fetch(url, options)
        .then(res => res.json()) 
        .then(data => {
            showMovies(data);
        })
        .catch(err => {
            console.error('Fejl ved hentning af film: ', err);
        });
}

function showMovies(data) {
    movieContainer.innerHTML = ''; 
    data.forEach(movie => {
        const { title, poster_path, vote_average, overview } = movie;

        if (!poster_path) {
            return; 
        }

        const cardRoshni = document.createElement('div');
        cardRoshni.classList.add('card-roshni');
        cardRoshni.innerHTML = `
            <img src="${IMG_URL + poster_path}" alt="${title}">
            <div class="">
                <h3>${title}</h3>
                <span class="${getColor(vote_average)}">${vote_average}</span>
                <div class="movie-description">
                    <p>${overview}</p>
                </div>
            </div>
        `;
        movieContainer.append(cardRoshni);
    });
}

function getColor(vote) {
     if (vote >= 8) {
         return 'green';
     } else if (vote >= 5) {
         return 'orange';
     } else {
         return 'red';
     }
 }
searchForm.addEventListener('submit', () => {
    const searchTerm = search.value;
    if (searchTerm) {
        getMovies(searchURL + '&query=' + encodeURIComponent(searchTerm));
    } else {
        movieContainer.innerHTML = '<p>Indtast venligst en søgeterm</p>';
    }
});



