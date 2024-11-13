<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Netflix Style Web App</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{ asset('mainstyle.css') }}" rel="stylesheet"> <!-- Make sure this is correct path -->
  <style>
    /* Small Cross Button */
    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 30px;
      color: white;
      background: rgba(0, 0, 0, 0.5);
      border: none;
      border-radius: 50%;
      padding: 5px;
      cursor: pointer;
      z-index: 10;
    }

    .close-btn:hover {
      background: rgba(0, 0, 0, 0.7);
    }

    /* Video Player Container */
    .video-player-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: none;
      justify-content: center;
      align-items: center;
      background: rgba(0, 0, 0, 0.7);
      z-index: 9999;
    }

    /* Video Iframe */
    .video-iframe {
      width: 60vw; /* 60% of the screen width */
      height: 80vh; /* 80% of the screen height */
      object-fit: cover;
      border: none;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('images/netflix_logo.png') }}" alt="Netflix Logo">
    </div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">TV Shows</a></li>
        <li><a href="#">Movies</a></li>
        <li><a href="#">New & Popular</a></li>
        <li><a href="#">My List</a></li>
      </ul>
    </nav>
  </header>

  <!-- Search Box -->
  <div class="search-box">
    <input type="text" id="search-input" placeholder="Search for movies..." />
    <button id="search-btn">Search</button>
  </div>

  <!-- Movie Category Buttons -->
  <button id="popular-movies-btn">Popular Movies</button>
  <button id="top-rated-movies-btn">Top Rated Movies</button>

  <!-- Movie Cards Section -->
  <div class="card-container" id="movie-container">
    <!-- Movies will be dynamically added here -->
  </div>

  <!-- Video Player Container -->
  <div class="video-player-container" style="display: none;">
    <!-- Cross Button on Top-Right -->
    <button class="close-btn" onclick="closeVideoPlayer()">&#10005;</button>
    <!-- The iframe will be dynamically inserted here -->
  </div>

  <script>
    const apiKeyTMDb = '763236967f78e251208361795261b5b7'; // TMDb API Key
    const apiKeyOMDb = 'ec51cad'; // OMDb API Key
    const movieContainer = document.getElementById('movie-container');
    const videoPlayerContainer = document.querySelector('.video-player-container');
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');
    const popularMoviesBtn = document.getElementById('popular-movies-btn');
    const topRatedMoviesBtn = document.getElementById('top-rated-movies-btn');
    let movieCache = new Set(); // To track unique movies and prevent duplicates

    // Function to fetch and display movies from TMDb
    function fetchMovies(query = '', page = 1, type = 'popular') {
      let apiUrl = `https://api.themoviedb.org/3/movie/${type}?api_key=${apiKeyTMDb}&language=en-US&page=${page}`;
      
      if (query) {
        apiUrl = `https://api.themoviedb.org/3/search/movie?api_key=${apiKeyTMDb}&language=en-US&query=${query}&page=${page}`;
      }

      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          movieContainer.innerHTML = ''; // Clear previous results
          if (data.results && data.results.length > 0) {
            data.results.forEach(movie => {
              if (!movieCache.has(movie.id)) {
                movieCache.add(movie.id); // Add movie to cache to avoid duplicate
                const movieCard = document.createElement('div');
                movieCard.classList.add('card');
                
                const posterUrl = movie.poster_path 
                                  ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` 
                                  : 'https://via.placeholder.com/500x750?text=No+Image+Available'; // Fallback image if no poster available
                
                movieCard.innerHTML = `
                  <img class="card-img-top" src="${posterUrl}" alt="${movie.title}">
                  <div class="card-body">
                    <h5 class="card-title">${movie.title}</h5>
                    <p class="card-text">${movie.overview.substring(0, 100)}...</p>
                    <button class="btn" onclick="showVideoPlayer(${movie.id}, '${movie.title}')">Watch Now</button>
                  </div>
                `;
                movieContainer.appendChild(movieCard);
              }
            });
          } else {
            movieContainer.innerHTML = '<p>No movies found.</p>';
          }
        })
        .catch(error => console.error('Error fetching movie data:', error));
    }

    // Fetch popular movies initially
    fetchMovies('', 1, 'popular');

    // Show Video Player
    function showVideoPlayer(movieId, movieTitle) {
      movieContainer.style.display = 'none'; // Hide movie container
      videoPlayerContainer.style.display = 'flex'; // Show video player container
    
      // Fetch details from OMDb for video player
      const apiUrl = `https://www.omdbapi.com/?apikey=${apiKeyOMDb}&i=${movieId}`;
    
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          const iframe = document.createElement('iframe');
          iframe.classList.add('video-iframe');
          iframe.src = `https://v2.vidsrc.me/embed/${movieId}`;
          iframe.frameBorder = "0";
          iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
          iframe.allowFullscreen = true;
    
          videoPlayerContainer.innerHTML = ''; // Clear previous iframe
          videoPlayerContainer.appendChild(iframe); // Add new iframe
        })
        .catch(error => {
          console.error('Error fetching video data from OMDb:', error);
        });
    }

    // Close Video Player
    function closeVideoPlayer() {
      movieContainer.style.display = 'flex'; // Show movie container again
      videoPlayerContainer.style.display = 'none'; // Hide video player container
    }

    // Search Button Click Event
    searchBtn.addEventListener('click', function() {
      const query = searchInput.value.trim();
      if (query) {
        fetchMovies(query); // Fetch movies based on search query
      } else {
        fetchMovies('', 1, 'popular'); // Fetch popular movies if the search input is empty
      }
    });

    // Handle Enter Key Press in the Search Input
    searchInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const query = searchInput.value.trim();
        if (query) {
          fetchMovies(query); // Fetch movies based on search query
        } else {
          fetchMovies('', 1, 'popular'); // Fetch popular movies if the search input is empty
        }
      }
    });

    // Switch to Popular Movies
    popularMoviesBtn.addEventListener('click', function() {
      fetchMovies('', 1, 'popular'); // Fetch popular movies when clicked
    });

    // Switch to Top Rated Movies
    topRatedMoviesBtn.addEventListener('click', function() {
      fetchMovies('', 1, 'top_rated'); // Fetch top-rated movies when clicked
    });
  </script>

</body>
</html>
