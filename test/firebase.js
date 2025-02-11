const firebaseConfig = {
    apiKey: "AIzaSyCvvvLTYpR3QsxYBEM7KrN_m3IfT8ZCmsE",
    authDomain: "moviball-2a66a.firebaseapp.com",
    projectId: "moviball-2a66a",
    storageBucket: "moviball-2a66a.firebasestorage.app",
    messagingSenderId: "728145809854",
    appId: "1:728145809854:web:e5e15a3c097ed20a4be9ef",
    measurementId: "G-9LQKNXKZ56"
};

// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();