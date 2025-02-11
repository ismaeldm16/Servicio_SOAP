const API_KEY = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtYXJ0aW51cmJhbm8uc2VyZ2lvQGdtYWlsLmNvbSIsImp0aSI6IjA3OWQxOGVlLTI1OWQtNGZmZi1iNTlkLWIxMjU2MTBmOTg0MCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzM3OTgwODg0LCJ1c2VySWQiOiIwNzlkMThlZS0yNTlkLTRmZmYtYjU5ZC1iMTI1NjEwZjk4NDAiLCJyb2xlIjoiIn0.FtkjMPPRzZU6ZLmE3bjhI_kOyydC0LoFed7z6syx-Dk";

document.getElementById("mapaIsobaras").addEventListener("click", () => obtenerMapaIsobaras())
document.getElementById("infoCanarias").addEventListener("click", () => obtenerInfoCanarias())
document.getElementById("infoGranCanaria").addEventListener("click", () => obtenerInfoGranCanaria())

async function obtenerMapaIsobaras() {
  try {
    const response = await fetch(`https://opendata.aemet.es/opendata/api/mapasygraficos/analisis?api_key=${API_KEY}`)
    const data = await response.json()
    const blobResponse = await fetch(data.datos)
    const blob = await blobResponse.blob()
    const imageUrl = URL.createObjectURL(blob)
    document.getElementById("resultado").innerHTML = `<img src="${imageUrl}" alt="Mapa de isobaras">`
  } catch (error) {
    console.error("Error:", error)
    document.getElementById("resultado").innerHTML = `<p>Error al obtener el mapa de isobaras: ${error.message}</p>`
  }
}

async function obtenerInfoCanarias() {
  try {
    const response = await fetch(`https://opendata.aemet.es/opendata/api/prediccion/ccaa/hoy/coo/?api_key=${API_KEY}`)
    const data = await response.json()
    const bufferResponse = await fetch(data.datos)
    const buffer = await bufferResponse.arrayBuffer()
    const decoder = new TextDecoder("iso-8859-1")
    const text = decoder.decode(buffer)
    let prediccion
    try {
      const data = JSON.parse(text)
      prediccion = data[0].prediccion
    } catch (e) {
      console.warn("La respuesta no es JSON válido. Mostrando texto plano.")
      prediccion = text
    }
    document.getElementById("resultado").innerHTML = `
            <table>
                <tr><th>Predicción Canarias</th></tr>
                <tr><td>${prediccion}</td></tr>
            </table>
        `
  } catch (error) {
    console.error("Error:", error)
    document.getElementById("resultado").innerHTML =
      `<p>Error al obtener la información de Canarias: ${error.message}</p>`
  }
}

async function obtenerInfoGranCanaria() {
    try {
      const response = await fetch(`https://opendata.aemet.es/opendata/api/prediccion/provincia/manana/353/?api_key=${API_KEY}`);
      const data = await response.json();
      
      // Hacer una segunda solicitud a la URL contenida en `datos`
      const dataUrl = data.datos;
      const bufferResponse = await fetch(dataUrl);
      const buffer = await bufferResponse.arrayBuffer();
      
      // Decodificar el contenido (el archivo es probablemente en ISO-8859-1)
      const decoder = new TextDecoder("iso-8859-1");
      const text = decoder.decode(buffer);
      
      let prediccion;
      try {
        // Intenta parsear el texto como JSON
        const data = JSON.parse(text);
        prediccion = data[0].prediccion;
      } catch (e) {
        // Si no es JSON válido, mostrar el texto plano
        console.warn("La respuesta no es JSON válido. Mostrando texto plano.");
        prediccion = text;
      }
  
      // Mostrar la predicción
      document.getElementById("resultado").innerHTML = `
        <table>
          <tr><th>Predicción Gran Canaria - Mañana</th></tr>
          <tr><td>${prediccion}</td></tr>
        </table>
      `;
    } catch (error) {
      console.error("Error:", error);
      document.getElementById("resultado").innerHTML =
        `<p>Error al obtener la predicción de Gran Canaria para mañana: ${error.message}</p>`;
    }
  }
  