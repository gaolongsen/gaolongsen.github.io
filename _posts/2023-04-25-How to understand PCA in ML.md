---
layout:     post
title:      How to understand PCA(Principal Component Analysis) in ML
subtitle:   
date:       2023-04-25
author:     Longsen Gao
header-img: img/background2.jpg
catalog: 	true
tags:
    - Machine Learning


---

The aim of this article is to offer a comprehensive and accessible explanation of **Principal Component Analysis (PCA)**. The article will guide readers through the PCA process in a simplified, yet comprehensive manner, regardless of their mathematical background.

While there is an abundance of information available on PCA, many resources tend to be overly technical, delving into the intricacies of the topic and overlooking the fundamental concepts that underlie it. In contrast, this article provides a clear and simplified overview of PCA, allowing readers to grasp its key concepts and application.

PCA involves a five-step process, each of which will be explained in detail. Rather than focusing on computational procedures, this article will concentrate on logical explanations of the key concepts that make up PCA, including standardization, covariance, eigenvectors, and eigenvalues. By the end of the article, readers will have a comprehensive understanding of PCA and its relevance in various fields, without being bogged down in complex mathematical formulae.

## Defination of PCA

Principal Component Analysis (PCA) is a widely used technique for dimensionality reduction of large datasets. The aim of PCA is to transform a set of variables into a smaller set that retains most of the important information from the original data. By reducing the number of variables, the resulting dataset is more manageable and easier to analyze. This simplification enhances the performance of machine learning algorithms, which can process data more efficiently and accurately without the burden of unnecessary variables.

Although the reduction of variables can lead to some loss of accuracy, the benefits of dimensionality reduction generally outweigh this drawback. By eliminating redundant or insignificant variables, the data becomes easier to explore, visualize and analyze, and can provide valuable insights that were previously obscured by high dimensionality.

In summary, the primary objective of PCA is to ***reduce the dimensionality of a dataset while preserving as much information as possible.*** This allows for more efficient processing and analysis of the data, facilitating improved decision-making and knowledge discovery.

## How PCA works?

#### First: STANDARDIZATION

The initial step in PCA is to standardize the continuous variables to ensure that they contribute equally to the analysis. This is critical because PCA is sensitive to the variances of the initial variables. If the ranges of the initial variables are significantly different, those with larger ranges will dominate over those with smaller ranges. For example, a variable with a range between 0 and 100 will dominate over a variable with a range between 0 and 1, leading to biased results. Standardizing the data to comparable scales can help avoid this problem.

Standardization involves mathematically transforming the data by subtracting the mean and dividing by the standard deviation for each value of each variable. This process ensures that each variable has a mean of zero and a standard deviation of one, resulting in a dataset with a common scale for all variables. By applying standardization, the PCA can be performed on a dataset where each variable has an equal contribution to the analysis, regardless of the scale of their initial values.

In summary, standardization is a crucial first step in PCA that ensures unbiased results by reducing the impact of variable scale differences. 



![](https://latex.codecogs.com/svg.image?\huge&space;z&space;=&space;\dfrac{x&space;-&space;\mu}{\sigma})



Where $x$ is the value of the data, $\miu$ is the mean of the set, $\sigma$ is the standard deviation value. By transforming the data into comparable scales, PCA can be performed on a dataset where each variable contributes equally to the analysis, resulting in more accurate and meaningful results.

#### Second: Compute Covariance Matrix $\varSigma$

 
