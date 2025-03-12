FROM debian:12.6
EXPOSE 7860
RUN apt update -y
RUN apt upgrade -y
RUN apt install -y php php8.2-mysql
RUN rm -rf /var/lib/apt/lists/*
COPY . /
WORKDIR /public
CMD ["bash","-c","php -S 0.0.0.0:7860"]