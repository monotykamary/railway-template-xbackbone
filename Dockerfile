FROM docker.io/linuxserver/xbackbone:3.8.2@sha256:18f7cde23701a8dea9672e6754e3ea40f62fe0771abe08271347b7ad9972fcbb
COPY bootstrap.php /usr/local/bin/xbackbone-bootstrap.php
RUN sed -i '/# permissions/i php /usr/local/bin/xbackbone-bootstrap.php\nrm -rf /app/www/public/install' /etc/s6-overlay/s6-rc.d/init-xbackbone-config/run
EXPOSE 80
