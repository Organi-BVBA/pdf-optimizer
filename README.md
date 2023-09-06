# Pdf Optimizer

```bash
docker run \
    --volume=$PWD/data:/data \
    --publish=8081:80 \
    --env=DB_HOST=mysql \
    --env=DB_DATABASE=pdf_optimizer \
    --env=DB_USERNAME=root \
    --env=DB_PASSWORD=root \
    --restart=always \
    --detach=true \
    --name=pdf-optimizer \
    rvkorgani/pdf-optimizer
```
