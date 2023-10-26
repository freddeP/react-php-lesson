import Quotes from "./components/quotes";
import CreateQuote from "./components/createQuote";
import { useEffect, useState } from "react";

function App() {

    // Fixa state för våra quotes som kommer från servern...
    const [quotes, setQuotes] = useState([]);

    async function getQuotes(){

        let response = await fetch("./quotes");
        let data = await response.json();
        setQuotes(data);

    }

    useEffect(()=>{
        getQuotes();
    },[]);






    return ( 

        <div>
            <h2>My Quotes app</h2>

            <CreateQuote setQuotes ={setQuotes}></CreateQuote>
            <hr />
            <Quotes quotes={quotes}></Quotes>

            <hr />

            <form action="./register" method="post">
                <input type="text" name="name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <input type="submit" value="Register" />
            </form>
     


        </div>
    

     );
}

export default App;