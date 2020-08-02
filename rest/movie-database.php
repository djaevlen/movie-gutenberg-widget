<?php

if (class_exists('WP_REST_Controller')) {

    class MovieDatabase extends WP_REST_Controller
    {

        // Should be saved in a .env file
        private $api_key = false;

        /*
        *   Construct the class
         */
        function __construct()
        {
            add_action('rest_api_init', [$this, 'register_routes']);

            if (get_option('MGW_api_key')) {
                $this->api_key = get_option('MGW_api_key');
            }
        }

        /**
         * Register the routes for the objects of the controller.
         */
        public function register_routes()
        {

            register_rest_route('mgw', '/v1/movie/search', [

                [
                    'methods'               => WP_REST_Server::READABLE,
                    'callback'              => [$this, 'search_for_movie'],
                    'permission_callback'   => [$this, 'is_public'],
                    'args'                  => [
                        'search'          => [
                            'required'  => true
                        ]
                    ]
                ]
            ]);

            register_rest_route('mgw', '/v1/movie/get', [

                [
                    'methods'               => WP_REST_Server::READABLE,
                    'callback'              => [$this, 'get_movie'],
                    'permission_callback'   => [$this, 'is_public'],
                    'args'                  => [
                        'movie_id'          => [
                            'required'  => true
                        ]
                    ]
                ]
            ]);
        }

        /**
         * Check if user is admin
         */
        public function is_admin()
        {
            return current_user_can('manage_options');
        }


        /**
         * Check if user is public user
         */
        public function is_public()
        {
            return true;
        }

        /**
         * Search for movie
         */
        public function search_for_movie($request)
        {
            $search = wp_remote_get('https://api.themoviedb.org/3/search/movie?api_key=' . $this->api_key . '&query=' . $request['search']);

            return new WP_REST_Response(json_decode($search['body']), 200);
        }

        /**
         * Get movie from The Movie Database
         */
        public function get_movie($request)
        {

            $movie = wp_remote_get('https://api.themoviedb.org/3/movie/' . $request['movie_id'] . '?api_key=' . $this->api_key);

            return new WP_REST_Response(json_decode($movie['body']), 200);
        }
    }
    new MovieDatabase();
}
