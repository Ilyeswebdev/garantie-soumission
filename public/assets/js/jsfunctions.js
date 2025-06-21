function success(type, action) {
  document.addEventListener("DOMContentLoaded", function () {
    const url = window.location.href; // Example: 'home.php?id=2'

    // Create a URLSearchParams object with the current URL query string
    const urlParams = new URLSearchParams(window.location.search);

    // Retrieve the 'id' parameter from the URL
    const code = urlParams.get("code");
    let actionPerformed = false;
    // Output the result
    if (actionPerformed == false) {
      Swal.fire({
        title: ` ${action} `,
        html:
          type +
          " <b style='color: #ED0800;'> " +
          code +
          ` </b> ${action} avec succéss`,
        icon: "success",
        confirmButtonText: "OK",
      });
      actionPerformed = true;
    }
    if (actionPerformed == true) {
      window.history.replaceState(null, "", `index.php?page=${type}`);
    }
  });
}
function normalsuccess(type, action) {
  document.addEventListener("DOMContentLoaded", function () {
    // let actionPerformed = false;

    // if (actionPerformed == false) {
    Swal.fire({
      title: ` ${action} `,
      html:
        type +
        " <b style='color: #ED0800;'> " +
        code +
        ` </b> ${action} avec succéss`,
      icon: "success",
      confirmButtonText: "OK",
    });
    // actionPerformed = true;
    // }
  });
}
