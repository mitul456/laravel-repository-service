# Laravel Repository & Service Pattern Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mitul456/laravel-repository-service.svg)](https://packagist.org/packages/mitul456/laravel-repository-service)
[![Total Downloads](https://img.shields.io/packagist/dt/mitul456/laravel-repository-service.svg)](https://packagist.org/packages/mitul456/laravel-repository-service)
[![License](https://img.shields.io/packagist/l/mitul456/laravel-repository-service.svg)](https://github.com/mitul456/laravel-repository-service/blob/main/LICENSE)

একটি শক্তিশালী Laravel প্যাকেজ যা Repository Pattern এবং Service Layer স্বয়ংক্রিয়ভাবে তৈরি করে। আপনার Laravel অ্যাপ্লিকেশনকে আরও ক্লিন, মেইন্টেইনেবল এবং টেস্টেবল করতে এই প্যাকেজটি ব্যবহার করুন।

## 📋 টেবিল অফ কন্টেন্ট
- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
  - [Create Repository and Service Together](#1-create-repository-and-service-together)
  - [Create Only Repository](#2-create-only-repository)
  - [Create Only Service](#3-create-only-service)
- [Examples](#-examples)
  - [Basic CRUD Example](#basic-crud-example)
  - [Custom Repository Methods](#custom-repository-methods)
  - [Custom Service Methods](#custom-service-methods)
- [Directory Structure](#-directory-structure)
- [Testing](#-testing)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

- 🚀 **Auto Generate** - Repository এবং Service layer স্বয়ংক্রিয়ভাবে তৈরি করুন
- 📦 **Base Repository** - Common CRUD operations সহ Base Trait
- 🔧 **Flexible** - আলাদাভাবে Repository বা Service তৈরি করতে পারবেন
- 🎯 **PSR-4 Compatible** - Modern PHP standards অনুসরণ করে
- 💉 **Dependency Injection Ready** - Easily inject in controllers
- 📝 **Configurable** - কাস্টম namespace এবং path সেট করতে পারবেন
- 🎨 **Clean Architecture** - Separation of concerns মেইন্টেইন করে

## 📋 Requirements

- PHP ^8.0 বা তার উপরে
- Laravel ^10.0 বা ^11.0
- Composer

## 🔧 Installation

### Step 1: প্যাকেজ ইনস্টল করুন

```bash
composer require mitul456/laravel-repository-service