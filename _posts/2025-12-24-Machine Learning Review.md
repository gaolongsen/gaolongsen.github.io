---
title: "Machine Learning Review"
date: 2025-12-24T07:00:00-04:00
categories:
  - blog
tags:
  - Machine Learning
  - NLP
---

# **Machine Learning Review**

 <img src="https://github.com/gaolongsen/picx-images-hosting/raw/master/ML.4qrsj2c4kj.webp" style="zoom: 20%;" /><img src="https://github.com/gaolongsen/picx-images-hosting/raw/master/ML2.3uvb3m3f6g.webp" style="zoom: 25%;" />

This document will go over through all machine learning concepts with related examples in robotics to go over through all related topics to help every roboticist to solid the background in machine learning.



## 1. Linear Regression

### 1.1 what's the linear regression?

**Linearity**: A relationship between two variables defined by a first-degree (linear) function. Graphically, this relationship is represented as a **straight line**.

**Non-linearity**: A relationship between two variables that is not a first-degree function. Consequently, its graphical representation is **not a straight line**.

**Regression**: When measuring phenomena, objective limitations often mean that we obtain "observed values" rather than the "true value." To approximate the true value, one would theoretically perform an infinite number of measurements and use that data to calculate a path back to the truth. This process of "returning" or "regressing" to the true value from observed data is the origin of the term.

### 1.2  What Problems Can It Solve?

Linear regression is used to process large volumes of observational data to derive mathematical expressions that align with the underlying patterns of a phenomenon. In other words, it uncovers the inherent relationships within the data, allowing us to simulate outcomes and perform **predictive analysis**.

Essentially, it solves the problem of using **known data** to determine **unknown results**.

**Common Applications**:

- **Real Estate**: Predicting housing prices based on variables like square footage or location.
- **Finance**: Assessing credit ratings or risk levels.
- **Entertainment**: Estimating movie box office performance.

### 1.3 What is the General Expression?

The standard mathematical form for a simple linear regression model is:
$$
Y = wx + b
$$
In this expression:

- $ w $ ** (Coefficient)**: Also referred to as the **weight** or **slope**, it represents the influence of the independent variable $x$ on the output $Y$.
- **$ b $ (Bias Term)**: Also known as the **intercept** or **offset**, it represents the value of $Y$ when $x$ is zero.

