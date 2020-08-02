import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";
import AsyncSelect from "react-select/async";

registerBlockType("mgw/widget", {
  title: "Movie Widget",
  icon: "tickets-alt",
  category: "common",
  attributes: {
    movieTitle: {
      type: "string",
      source: "html",
      selector: "h4.title",
    },
    movieTagLine: {
      type: "string",
      source: "html",
      selector: "h6.tag-line",
    },
    movieOverview: {
      type: "string",
      source: "html",
      selector: "div.overview",
    },
    movieRating: {
      type: "string",
      source: "html",
      selector: "dd.rating",
    },
    movieRunTime: {
      type: "string",
      source: "html",
      selector: "dd.runtime",
    },
    movieImdbLink: {
      type: "string",
      source: "attribute",
      selector: "a.imdb",
      attribute: "href",
    },
    moviePosterUrl: {
      type: "string",
      source: "attribute",
      selector: "img.poster",
      attribute: "src",
    },
    moviePosterTitle: {
      type: "string",
      source: "attribute",
      selector: "img.poster",
      attribute: "alt",
    },
  },
  example: {
    attributes: {
      movieTitle: "",
      movieTagLine: "",
      movieOverview: "",
      movieRating: "",
      movieRunTime: "",
      movieImdbLink: "",
      moviePosterUrl: "",
      moviePosterTitle: "",
    },
  },
  edit: (props) => {
    const {
      attributes: {
        movieTitle,
        movieTagLine,
        movieOverview,
        movieRating,
        movieRunTime,
        movieImdbLink,
        moviePosterUrl,
        moviePosterTitle,
      },
      setAttributes,
      className,
    } = props;

    const searchMovie = async (search) => {
      let response = await fetch(
        "/wp-json/mgw/v1/movie/search?search=" + search,
        {
          cache: "no-cache",
          headers: {
            "user-agent": "WP Block",
            "content-type": "application/json",
          },
          method: "GET",
          redirect: "follow",
          referrer: "no-referrer",
        }
      );
      let data = await response.json();
      return data.results;
    };

    const getMovie = async (movie_id) => {
      let response = await fetch(
        "/wp-json/mgw/v1/movie/get?movie_id=" + movie_id,
        {
          cache: "no-cache",
          headers: {
            "user-agent": "WP Block",
            "content-type": "application/json",
          },
          method: "GET",
          redirect: "follow",
          referrer: "no-referrer",
        }
      );
      let data = await response.json();
      return data;
    };

    const loadOptions = (inputValue, callback) => {
      searchMovie(inputValue).then((data) => {
        let movieList = data.map((movie) => ({
          value: movie.id,
          label:
            movie.title +
            " (" +
            new Date(movie.release_date).getFullYear() +
            ")",
        }));
        callback(movieList);
      });
    };

    const handleInputChange = (newValue) => {
      return newValue;
    };

    const handleOnChange = (newValue) => {
      getMovie(newValue.value).then((data) =>
        setAttributes({
          movieTitle: data.title,
          movieTagLine: data.tagline,
          movieOverview: data.overview,
          movieRating: data.vote_average,
          movieRunTime: data.runtime,
          movieImdbLink: "https://www.imdb.com/title/" + data.imdb_id,
          moviePosterUrl: "https://image.tmdb.org/t/p/w400/" + data.poster_path,
          moviePosterTitle: data.title,
        })
      );
      return newValue;
    };

    return (
      <div>
        <AsyncSelect
          cacheOptions
          loadOptions={loadOptions}
          onChange={handleOnChange}
          onInputChange={handleInputChange}
          onSelectResetsInput={true}
          onBlurResetsInput={false}
          placeholder="Search for movie title here..."
          noOptionsMessage={() => "Start typing to see movie results here"}
        />
        <div className={className}>
          {movieTitle && (
            <div className="wrapper">
              <div className="details">
                <img
                  className="poster"
                  src={moviePosterUrl}
                  alt={moviePosterTitle}
                />
                <dl>
                  <dt>Rating</dt>
                  <dd className="rating">{movieRating}</dd>
                  <dt>Runtime</dt>
                  <dd className="runtime">{movieRunTime}</dd>
                </dl>
                <a class="imdb" href={movieImdbLink}>
                  See it on Imdb.com
                </a>
              </div>
              <div className="content">
                <h4 className="title">{movieTitle}</h4>
                <h6 className="tag-line">{movieTagLine}</h6>
                <div className="overview">{movieOverview}</div>
              </div>
            </div>
          )}
        </div>
      </div>
    );
  },
  save: (props) => {
    const {
      className,
      attributes: {
        movieTitle,
        movieTagLine,
        movieOverview,
        movieRating,
        movieRunTime,
        movieImdbLink,
        moviePosterUrl,
        moviePosterTitle,
      },
    } = props;

    return (
      <div className={className}>
        {movieTitle && (
          <div className="wrapper">
            <div className="details">
              <img
                className="poster"
                src={moviePosterUrl}
                alt={moviePosterTitle}
              />
              <dl>
                <dt>Rating</dt>
                <dd className="rating">{movieRating}</dd>
                <dt>Runtime</dt>
                <dd className="runtime">{movieRunTime}</dd>
              </dl>
              <a
                class="imdb"
                href={movieImdbLink}
                target="_blank"
                rel="noopener noreferrer"
              >
                See it on Imdb.com
              </a>
            </div>
            <div className="content">
              <h4 className="title">{movieTitle}</h4>
              <h6 className="tag-line">{movieTagLine}</h6>
              <div className="overview">{movieOverview}</div>
            </div>
          </div>
        )}
      </div>
    );
  },
});
