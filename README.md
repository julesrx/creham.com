# Créham
Urbanisme, paysage, sociologie et développement local.

Reprise du site du Créham avec [Jekyll](https://jekyllrb.com/).

# Docker
- run : `docker-compose up`
- build : `docker run --rm -v $PWD:/srv/jekyll -v $PWD/vendor/bundle:/usr/local/bundle -it jekyll/jekyll:3.8 jekyll build`
