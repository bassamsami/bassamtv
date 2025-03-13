const firebaseConfig = {
  apiKey: "AIzaSyAZDgvZgJM3Yq_OdpuhTZAUORSZqHfVbTY",
  authDomain: "moviball-cc804.firebaseapp.com",
  projectId: "moviball-cc804",
  storageBucket: "moviball-cc804.firebasestorage.app",
  messagingSenderId: "660657863561",
  appId: "1:660657863561:web:fe82c69a31a7359e723f58",
  measurementId: "G-XNK1ZBMW0E"
};

// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();