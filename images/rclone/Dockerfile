FROM rclone/rclone

RUN apk update && apk upgrade && apk add bash

COPY files/setup.sh /opt

ENTRYPOINT [ "bash", "/opt/setup.sh" ]