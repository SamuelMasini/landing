const functions = require("firebase-functions");
const admin = require("firebase-admin");
const cors = require("cors");
// const axios = require("axios").default;
const Mailjet = require("node-mailjet");

const express = require("express");

const app = express();
app.use(cors());
app.use( express.json() );
const axios = require("axios");

admin.initializeApp();

app.get("/", (req, res) => {
  res.send("Hello World!");
}
);

app.post("/send_email", (req, res) => {
  try {
    const mailjet = new Mailjet({
      apiKey: process.env.MJ_APIKEY_PUBLIC ||
      "",
      apiSecret: process.env.MJ_APIKEY_PRIVATE ||
      "",
    });
    const request = mailjet.post("send", {version: "v3.1"}).request({
      Messages: [
        {
          From: {
            Email: process.env.SENDER_EMAIL,
            Name: "Enviamas web",
          },
          To: [
            {
              Email: process.env.RECIPIENT_EMAIL,
              Name: "You",
            },
          ],
          Subject: "Enviamas",
          HTMLPart: "Nombre del cliente: " + req.body.nombre + "<br>" +
          "Correo: " + req.body.correo + "<br>" +
          "Teléfono: " + req.body.telefono + "<br>" +
          "Empresa: " + req.body.empresa,

        },
      ],
    });
    request
        .then((result) => {
          console.log(result.body);
        })
        .catch((err) => {
          console.log(err.statusCode);
        });
    res.status(200).json({
      success: true,
      message: "Email sent",
    });
  } catch (err) {
    console.log(err);
    res.status(500).json({
      success: false,
      message: "Error sending email, hable con el administrador",
    });
  }
});

app.post("/post_slack", (req, res) => {
  try {
    const payload = {
      text: "*NUEVO CLIENTE*" + "\n" +
      "Nombre del cliente: " + req.body.nombre + "\n" +
      "Correo: " + req.body.correo + "\n" +
      "Teléfono: " + req.body.telefono + "\n" +
      "Empresa: " + req.body.empresa,
    };
    axios.post(process.env.SLACK_WEBHOOK_URL, payload)
        .then((result) => {
          res.status(200).json({
            data: result,
          });
        })
        .catch((error) => {
          res.status(400).json({
            success: false,
            message: "No se encontro",
          });
        });
  } catch (err) {
    console.log(err);
    res.status(500).json({
      success: false,
      message: "Error sending slack, hable con el administrador",
    });
  }
});

exports.app = functions.https.onRequest(app);

