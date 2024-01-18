
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-analytics.js";

        import {
            GoogleAuthProvider,
            getAuth,
            signInWithPopup
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-auth.js"
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyC7RG6qHRqNyPoGrffer4fUIGIYR1xpNzQ",
            authDomain: "rizqi-motor-32f51.firebaseapp.com",
            projectId: "rizqi-motor-32f51",
            storageBucket: "rizqi-motor-32f51.appspot.com",
            messagingSenderId: "463365809602",
            appId: "1:463365809602:web:97177ca8bc54dea2dbe25b",
            measurementId: "G-9YVGX5MPHC"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);


        const provider = new GoogleAuthProvider();
        const auth = getAuth();

        document.querySelector('#btn-google').addEventListener('click', function(e) {
            signInWithPopup(auth, provider)
                .then((result) => {
                    // This gives you a Google Access Token. You can use it to access the Google API.
                    const credential = GoogleAuthProvider.credentialFromResult(result);
                    const token = credential.accessToken;
                    // The signed-in user info.
                    const user = result.user;
                    const email = result.user.email;
                    const namaLengkap = result.user.displayName;
                    const profilePhoto = result.user.photoURL;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;


                    // simpan login
                    $.ajax({
                        type: "POST",
                        url: "/loginWithGoogle",
                        data: {
                            _token: csrfToken,
                            email: email,
                            nama_lengkap: namaLengkap,
                            profile_photo: profilePhoto
                        },
                        dataType: "json",
                        success: function(response) {


                            // Tanggapan berhasil
                            if (response.status === "success") {



                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Berhasil login.",
                                });
                                // Lakukan tindakan lain seperti mengarahkan pengguna atau memperbarui UI
                                window.location.href = '/';
                            } else {
                                // Tanggapan gagal

                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: "Terjadi kesalahan1.",
                                });
                                // Handle kesalahan sesuai kebutuhan
                            }
                        },
                        error: function(xhr, status, error) {
                            // Tanggapan error dari server
                            // console.error("Terjadi kesalahan3: " + error);
                            // console.error("Respons: " + xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: xhr.responseText,
                            });
                        }
                    });

                }).catch((error) => {
                    // Handle Errors here.
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    // The email of the user's account used.
                    const email = error.customData.email;
                    // The AuthCredential type that was used.
                    const credential = GoogleAuthProvider.credentialFromError(error);
                    $(document).ready(function() {

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan3.",
                        });


                    });
                });
        });

