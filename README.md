# SimpleDown - Mundo phpBB

[![phpBB Version](https://img.shields.io/badge/phpBB-3.3.x-blue.svg)](https://www.phpbb.com/)
[![License](https://img.shields.io/badge/license-GPL--2.0-blue.svg)](http://opensource.org/licenses/gpl-license.php)

O **SimpleDown** é uma extensão para phpBB 3.3 que oferece um sistema simplificado e eficiente para distribuição de arquivos. Com foco em usabilidade e segurança, ele permite gerenciar downloads diretamente pelo Painel de Administração (ACP).

## ? Funcionalidades

- **Gerenciamento Completo no ACP:** Envie arquivos (ZIP, PDF, Imagens, etc.) e gerencie-os facilmente.
- **Categorias Personalizadas:** Organize seus downloads por categorias.
- **Visibilidade Inteligente:** Escolha entre arquivos **Públicos** (todos podem baixar) ou **Privados** (apenas usuários logados).
- **Segurança:** - Verificação de conteúdo via hash MD5 para evitar duplicatas.
  - Arquivos armazenados em diretório protegido, servidos de forma segura via PHP.
- **Interface Responsiva:** Página dedicada em `/downloads` com design moderno, suporte a temas claro/escuro e busca em tempo real.
- **Miniaturas:** Suporte para pré-visualização de arquivos com miniaturas personalizáveis.
- **Ordenação Flexível:** Filtre por nome, tamanho ou número de downloads.

## ?? Requisitos

- **phpBB:** 3.3.0 ou superior.
- **PHP:** 7.1 ou superior.

## ?? Instalação

1. Baixe a versão mais recente do repositório.
2. No seu servidor, navegue até a pasta `ext/` da instalação do seu fórum.
3. Crie o diretório `mundophpbb/simpledown` (se ainda não existir).
4. Copie todo o conteúdo do repositório para `ext/mundophpbb/simpledown/`.
5. Vá ao **Painel de Controle da Administração (ACP)** > **Personalizar** > **Gerenciar Extensões**.
6. Localize **Simple Download** na lista e clique em **Habilitar**.

## ??? Extensões de Arquivos Suportadas

O SimpleDown suporta uma vasta gama de formatos, incluindo:
- **Documentos:** PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT.
- **Compactados:** ZIP, RAR, 7Z.
- **Imagens:** JPG, PNG, GIF, WEBP, SVG.
- **Mídia:** MP3, WAV, OGG, MP4, AVI, MKV, MOV.

## ?? Traduções

Atualmente disponível em:
- ???? Português Brasileiro (pt-br)
- ???? Inglês (en)
- ???? Francês (fr)

## ?? Licença

GPLv2 - [GNU General Public License v2](http://opensource.org/licenses/gpl-license.php)

---
**Desenvolvido por:** [Chico Gois](https://github.com/chicogois) - [Mundo phpBB](https://mundophpbb.com.br)