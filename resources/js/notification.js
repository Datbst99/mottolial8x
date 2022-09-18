// ES6 Modules or TypeScript
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

window.notification =  function(message, type) {
    Swal.fire({
        position: "top-end",
        type: type,
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        toast: true,
    })
}

