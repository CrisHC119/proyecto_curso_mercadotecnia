#!/bin/bash

DIR_ACTUAL="$(cd "$(dirname "$0")" && pwd)"

FECHA=$(date +%Y-%m-%d)
ORIGEN="$DIR_ACTUAL/assets/code_alumnos/"
DESTINO="gs://datos_mercadotecnia/archivos_alumnos_$FECHA/"

gsutil -m rsync -r "$ORIGEN" "$DESTINO"

echo "Respaldo completado el $FECHA desde $ORIGEN"