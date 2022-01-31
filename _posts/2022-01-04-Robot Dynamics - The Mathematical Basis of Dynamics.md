---
layout:     post
title:      Robot Dynamics - The Mathematical Basis of Dynamics
subtitle:   
date:       2022-01-04
author:     Longsen Gao
header-img: img/background5.jpg
catalog: 	true
tags:
    - Robot Direct Kinematics
    - DH Parameter

---

## 1. Trace

"**Trace**" is a concept in linear algebra where the sum of the diagonal elements of a square matrix is called a trace. For the following square matrix A: 

<img src="https://latex.codecogs.com/svg.image?A&space;=&space;\begin{pmatrix}a_{11}&space;&&space;a_{12}&space;&&space;a_{13}&space;&&space;...&space;&&space;a_{1n}&space;\\a_{21}&space;&&space;a_{22}&space;&&space;a_{23}&space;&&space;...&space;&&space;a_{2n}&space;\\a_{31}&space;&&space;a_{32}&space;&&space;a_{33}&space;&&space;...&space;&&space;a_{3n}&space;\\\vdots&space;&&space;\vdots&space;&&space;\vdots&space;&&space;\ddots&space;&&space;\vdots&space;\\a_{n1}&space;&&space;a_{n2}&space;&&space;a_{n3}&space;&&space;...&space;&&space;a_{nn}&space;&space;\end{pmatrix}&space;" title="A = \begin{pmatrix}a_{11} & a_{12} & a_{13} & ... & a_{1n} \\a_{21} & a_{22} & a_{23} & ... & a_{2n} \\a_{31} & a_{32} & a_{33} & ... & a_{3n} \\\vdots & \vdots & \vdots & \ddots & \vdots \\a_{n1} & a_{n2} & a_{n3} & ... & a_{nn} \end{pmatrix} " />

The Trace of A is:

<img src="https://latex.codecogs.com/svg.image?trace(A)&space;=&space;a_{11}&space;&plus;&space;a_{22}&space;&plus;&space;\cdots&space;&plus;&space;a_{nn}&space;=&space;\sum_{i&space;=&space;1}^n&space;a_{ii}&space;&space;" title="trace(A) = a_{11} + a_{22} + \cdots + a_{nn} = \sum_{i = 1}^n a_{ii} " />

The trace is a very important feature of the square as the following two reasons:

- [x] The "traces" of the similarity matrix are the same (some people compare the "trace" to the trace left by similar transformations).
- [x] The trace is the sum of the eigenvalues of the matrix.

After these two facts are shown here, the concept suddenly becomes complicated. Still, we will not discuss its many interpretations in detail here, using only the simplest definition, i.e., the sum of diagonal elements.

## 2. The inner product of a matrix

 You may have heard of the inner product of vectors, and here we have two vectors $ a=\begin{pmatrix} a_1 & a_2 & \dots & a_n \end{pmatrix}^T $ and $ b=\begin{pmatrix} b_1 & b_2 & \dots & b_n \end{pmatrix}^T $. So formally, the inner product of two vectors is the multiplication and addition of the corresponding elements (algebraic definition). You may have also seen such a definition 

<img src = "https://latex.codecogs.com/svg.image?\left<a,b\right>=\left|a\right|\left|b\right|cos(\theta)&space;" title="\left<a,b\right>=\left|a\right|\left|b\right|cos(\theta)"/>

The inner product of two vectors is equal to the product of the norm of the vectors multiplied by the cosine of the angle (geometric definition). These two definitions are equivalent. So what is the inner product of the matrix? The inner product of the matrix can be thought of as an extension of the inner product of vectors, which expresses the sum of the products of the corresponding elements of two matrices of the same size, with two matrices A and B, both with m rows and n columns, defined as follows 

<img src="https://latex.codecogs.com/svg.image?A&space;=&space;\begin{pmatrix}a_{11}&space;&&space;a_{12}&space;&&space;\cdots&space;&&space;a_{1n}&space;\\a_{21}&space;&&space;a_{22}&space;&&space;\cdots&space;&&space;a_{2n}&space;\\\vdots&space;&&space;\vdots&space;&&space;\ddots&space;&&space;\vdots&space;\\a_{m1}&space;&&space;a_{m2}&space;&&space;\cdots&space;&&space;a_{mn}&space;\\\end{pmatrix},&space;B&space;=&space;\begin{pmatrix}b_{11}&space;&&space;b_{12}&space;&&space;\cdots&space;&&space;b_{1n}&space;\\b_{21}&space;&&space;b_{22}&space;&&space;\cdots&space;&&space;b_{2n}&space;\\\vdots&space;&&space;\vdots&space;&&space;\ddots&space;&&space;\vdots&space;\\b_{m1}&space;&&space;b_{m2}&space;&&space;\cdots&space;&&space;b_{mn}&space;\\\end{pmatrix}" title="A = \begin{pmatrix}a_{11} & a_{12} & \cdots & a_{1n} \\a_{21} & a_{22} & \cdots & a_{2n} \\\vdots & \vdots & \ddots & \vdots \\a_{m1} & a_{m2} & \cdots & a_{mn} \\\end{pmatrix}, B = \begin{pmatrix}b_{11} & b_{12} & \cdots & b_{1n} \\b_{21} & b_{22} & \cdots & b_{2n} \\\vdots & \vdots & \ddots & \vdots \\b_{m1} & b_{m2} & \cdots & b_{mn} \\\end{pmatrix}" />

Then the inner product of matrices A and B can be defined as

<img src="https://latex.codecogs.com/svg.image?\left<A,B\right>&space;=&space;a_{11}b_{11}&space;&plus;&space;a_{12}b_{12}&space;&plus;&space;\cdots&space;&plus;&space;a_{mn}b_{mn}&space;=&space;\sum_{i=1}^m\sum_{j=1}^na_{ij}b_{ij}&space;&space;" title="\left<A,B\right> = a_{11}b_{11} + a_{12}b_{12} + \cdots + a_{mn}b_{mn} = \sum_{i=1}^m\sum_{j=1}^na_{ij}b_{ij} " />

It is interesting to note that we can simplify the expression of the inner product of matrices by using the concept of the trace. So the inner product of matrices A and B can also be expressed as: 

<img src="https://latex.codecogs.com/svg.image?\left<A,B\right>&space;=&space;trace(A^TB)&space;&space;" title="\left<A,B\right> = trace(A^TB) " />

Let's take an example of a two-dimensional square matrix to understand this equation. Let A and B be two two-dimensional square matrices (the inner product can be calculated as long as the matrices are of the same size, not necessarily be square), expressed as

<img src="https://latex.codecogs.com/svg.image?A&space;=&space;\begin{pmatrix}a_{11}&space;&&space;a_{12}&space;\\a_{21}&space;&&space;a_{22}&space;\\\end{pmatrix},B&space;=&space;\begin{pmatrix}b_{11}&space;&&space;b_{12}&space;\\b_{21}&space;&&space;b_{22}&space;\\\end{pmatrix}&space;&space;" title="A = \begin{pmatrix}a_{11} & a_{12} \\a_{21} & a_{22} \\\end{pmatrix},B = \begin{pmatrix}b_{11} & b_{12} \\b_{21} & b_{22} \\\end{pmatrix} " />

Based on the primordial definition of the inner product,  the inner product of these two matrices should be

<img src="https://latex.codecogs.com/svg.image?\left<A,B\right>&space;=&space;a_{11}b_{11}&space;&plus;&space;a_{12}b_{12}&space;&plus;&space;a_{21}b_{21}&space;&plus;&space;a_{22}b_{22}&space;&space;" title="\left<A,B\right> = a_{11}b_{11} + a_{12}b_{12} + a_{21}b_{21} + a_{22}b_{22} " />

Let's analyze this equation with trace operations

<img src="https://latex.codecogs.com/svg.image?A^TB=&space;\begin{pmatrix}a_{11}b_{11}&space;&plus;&space;a_{21}b_{21}&space;&&space;a_{11}b_{12}&space;&plus;&space;a_{21}b_{22}&space;\\a_{12}b_{11}&space;&plus;&space;a_{22}b_{21}&space;&&space;a_{12}b_{12}&space;&plus;&space;a_{22}b_{22}&space;\\\end{pmatrix}&space;&space;" title="A^TB= \begin{pmatrix}a_{11}b_{11} + a_{21}b_{21} & a_{11}b_{12} + a_{21}b_{22} \\a_{12}b_{11} + a_{22}b_{21} & a_{12}b_{12} + a_{22}b_{22} \\\end{pmatrix} " />

With the trace of $ A^TB $ above, you will find that the result exactly matches the original definition of the inner product of matrices.

## 3. Derivatives and Differentials

For this part, I recommend for the reader to look through the discuss for **[What is the difference between the differential and derivative of a function?](https://www.quora.com/What-is-the-difference-between-the-differential-and-derivative-of-a-function)**