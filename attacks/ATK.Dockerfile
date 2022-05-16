FROM ubuntu

COPY ./synattack.sh .
COPY ./goldenhttp.sh .
COPY ./GoldenEye .
COPY ./randip.py .
RUN apt-get update -y
RUN apt-get install -y python3
RUN echo "12\n10" | apt-get install -y hping3
ENTRYPOINT ["tail", "-f", "/dev/null"]