FROM hub.nctr.sd/emdad/emdad-base:latest
WORKDIR /var/www/html/
ADD emdad-backend emdad-backend
COPY emdad-backend/.env.example2 emdad-backend/.env
RUN rm -rf app && ln -s emdad-backend/ app

COPY ./script.sh ./
RUN chmod +x ./script.sh
#ENTRYPOINT ["supervisord", "-c", "/etc/supervisord.conf"]
ENTRYPOINT ["./script.sh"]
