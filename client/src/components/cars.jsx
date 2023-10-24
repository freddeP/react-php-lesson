import { useEffect, useState } from "react";


function Cars() {

    const [cars, setCars] = useState([]);

    async function getCars(){

        let response = await fetch("./data");
        let c = await response.json();
    
        setCars(prev=>[...c]);

    }

    // KALLA på getCars BARA EN GÅNG!!
    useEffect(()=>{
        console.log("USE EFFECT");
        getCars();
    },[]);



    return (  

        <div>

            {JSON.stringify(cars)}

        </div>

    );
}

export default Cars;

<div>

</div>
