document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content-wrapper");
    const sidebarCollapseBtn = document.getElementById("sidebarCollapse");

    sidebarCollapseBtn.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("collapsed");
    });
});