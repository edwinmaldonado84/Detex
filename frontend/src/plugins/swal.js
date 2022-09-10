import Swal from "sweetalert2/dist/sweetalert2.js";

const Toast = Swal.mixin({
  toast: true,
  position: "bottom-end",
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  iconColor: "#FFF",
  customClass: {
    popup: "toast_poup",
    title: "toast_text",
  },
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

//Vue.prototype.Toast = Toast;
window.Toast = Toast;
const SwalCustom = Swal.mixin({
  customClass: {
    title: "swal_text",
    popup: "swal_popup",
    content: "swal_text",
  },
});

window.Swal = Swal;

export default Swal;
