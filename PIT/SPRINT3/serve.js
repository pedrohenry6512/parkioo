const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const nodemailer = require('nodemailer');

const app = express();
const port = process.env.PORT || 3000;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Conectar ao MongoDB
mongoose.connect('mongodb://localhost:27017/parkio', { useNewUrlParser: true, useUnifiedTopology: true });

// Definir esquema e modelo do usuário
const userSchema = new mongoose.Schema({
    nome: String,
    email: String,
    senha: String,
    verificacaoCodigo: String,
    verificado: Boolean
});

const User = mongoose.model('User', userSchema);

// Configurar nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'seuemail@gmail.com',
        pass: 'suasenha'
    }
});

// Rota para cadastro de usuário
app.post('/register', async (req, res) => {
    const { nome, email, senha } = req.body;
    const verificacaoCodigo = Math.floor(1000 + Math.random() * 9000).toString();

    const user = new User({ nome, email, senha, verificacaoCodigo, verificado: false });

    try {
        await user.save();

        // Enviar email de verificação
        const mailOptions = {
            from: 'seuemail@gmail.com',
            to: email,
            subject: 'Código de Verificação - Parkio',
            text: `Seu código de verificação é: ${verificacaoCodigo}`
        };

        transporter.sendMail(mailOptions, (error, info) => {
            if (error) {
                return res.status(500).send('Erro ao enviar email de verificação');
            } else {
                res.status(200).send('Usuário cadastrado com sucesso. Verifique seu email.');
            }
        });
    } catch (error) {
        res.status(500).send('Erro ao cadastrar usuário');
    }
});

// Rota para verificar código
app.post('/verify', async (req, res) => {
    const { email, verificacaoCodigo } = req.body;

    try {
        const user = await User.findOne({ email });

        if (user.verificacaoCodigo === verificacaoCodigo) {
            user.verificado = true;
            await user.save();
            res.status(200).send('Usuário verificado com sucesso');
        } else {
            res.status(400).send('Código de verificação inválido');
        }
    } catch (error) {
        res.status(500).send('Erro ao verificar usuário');
    }
});

app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});


