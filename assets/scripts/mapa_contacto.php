<script>
    var map = L.map('map').setView([<?php echo $lat; ?>, <?php echo $lng; ?>], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([<?php echo $lat; ?>, <?php echo $lng; ?>]).addTo(map)
        .bindPopup("<?php echo $direccion; ?>")
        .openPopup();
</script>