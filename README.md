# ACF Gutenberg Block

A modern WordPress theme starter designed for creating custom Gutenberg blocks with **Advanced Custom Fields (ACF)** and a **Vite-powered build system** for optimized CSS and JS.

---

## 🧩 Overview

**ACF Gutenberg Block** is a developer-friendly WordPress theme starter.  
It combines the flexibility of **ACF** (Advanced Custom Fields) with the speed of **Vite** — giving you an efficient workflow for modern WordPress development.

Perfect for developers who want to build custom Gutenberg blocks or lightweight WordPress themes with a clean setup.

---

## ✨ Features

- ⚙️ Full ACF (Advanced Custom Fields) integration  
- 🚀 Vite for fast builds and hot module replacement (HMR)  
- 🧹 Automatic CSS/JS purging and minification  
- 🎨 Supports SCSS and PostCSS  
- 🧩 Gutenberg-ready structure  
- 🌐 Translation-ready  
- 🧱 Based on [Underscores (_s)](https://underscores.me/) for a clean foundation  

---

## 🛠️ Installation

1. In your WordPress admin panel, go to **Appearance → Themes → Add New**.  
2. Click **Upload Theme**, then choose the `.zip` file for this theme.  
3. Click **Install Now** and then **Activate**.  
4. (Optional) Install and activate **ACF Pro** for full block-building capabilities.

---

## 🧰 Development Setup (Optional)


If you want to edit or extend the theme:

```bash
# Install dependencies
npm install

# Auto-rebuild during development
npm run watch 

# Minifies JS and SCSS
npm run build 

# Removes unused CSS classes
npm run purge 

# Or do both
npm run build && npm run purge

```


## 🧾 Requirements

- WordPress 4.5+
- PHP 7.2+
- Node.js 20+ (for development mode)
- ACF or ACF Pro plugin


## 🧑‍💻 Author

- Ronnie Nillo
- 📧 ronnienillojobs@gmail.com
- 🌐 http://ronnienillo.github.io/

---

## 🦸 Hero Section Block (ACF Import)

This theme includes a **Hero Section Block** powered by **Advanced Custom Fields (ACF)**.

To enable it:

1. Locate the file `acf-hero-section-export.json` inside the theme (acf-gutenberg-block) folder.  
2. In your WordPress admin, go to:  
   **Custom Fields → Tools → Import Field Groups**.  
3. Click **Choose File**, select `acf-hero-section-export.json`, and then click **Import File**.  
4. The **Hero Section Block** will now be available inside the Gutenberg editor under “ACF Blocks”.
