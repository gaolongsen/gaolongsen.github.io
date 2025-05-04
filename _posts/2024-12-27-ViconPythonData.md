---
layout: post
title: How to get object information from Vicon System through Python?
date: 2024-12-27 18:00:00-0400
description: This tutorial will help you to use python to get the data from the Vicon directly and no rely on ROS.
tags: Vicon System, Python
categories: sample-posts
related_posts: false
giscus_comments: false
---

# **How to get object information from Vicon System through Python?**

 <img src="https://github.com/JackTony123/picx-images-hosting/raw/master/vicon.70aeh6yr4g.webp" style="zoom: 25%;" /><img src="https://github.com/JackTony123/picx-images-hosting/raw/master/Drone-Icon.26ljt93u7u.webp" style="zoom: 20%;" /><img src="https://github.com/JackTony123/picx-images-hosting/raw/master/4518857_python_icon.4jo6agcxb5.webp" style="zoom: 23%;" />

This tutorial will introduce how to use Python to get the motion information of the object including position and rotation with their derivations information from Vicon System. The full instruction can be find in this **[link](https://youtu.be/oUW-DhOWX7s?si=pIcDCmm7rIbJ2VRX)** :point_left:

Here is the example code below as showing in the tutorial video:

```python
from pyvicon_datastream import tools
import numpy as np
import matplotlib.pyplot as plt
from matplotlib.ticker import FuncFormatter
# Author: Longsen Gao
# Email: longsengao@gmail.com
# Tutorial for this file in Youtube: https://youtu.be/oUW-DhOWX7s

VICON_TRACKER_IP = "192.168.50.230"
OBJECT_NAME = "solar"

panel_pos_track = []


def changex(temp, position):
    return format(int(temp / 10) * 0.1, '.0f')


def vicon_data(VICON_TRACKER_IP, OBJECT_NAME):
    mytracker = tools.ObjectTracker(VICON_TRACKER_IP)
    posori = mytracker.get_position(OBJECT_NAME)

    while not posori:
        print("Wait for data")
        posori = mytracker.get_position(OBJECT_NAME)

    init_pos = np.asarray(posori[0])
    init_ori = np.asarray(posori[1])
    return init_pos, init_ori


dof_labels = ["x", "y", "z", r'$\alpha$', r'$\beta$', r'$\gamma$']
tf_labels = [r'$F_x$', r'$F_y$', r'$F_z$', r'$\tau_x$', r'$\tau_y$', r'$\tau_z$']

panel_pos_track = []
count = 0

while 1:
    panel_pos, panel_ori = vicon_data(VICON_TRACKER_IP, OBJECT_NAME)
    print("Position:",panel_pos)
    print("Rotation:",panel_ori)
    panel_pos_track.append(np.copy(panel_pos))
    count += 1
    if count > 100:
        break


panel_pos_track = np.squeeze(panel_pos_track)
# panel_pos_track = np.copy(panel_pos_track)
plt.plot(panel_pos_track[:, 0], label="X")
plt.plot(panel_pos_track[:, 1], label="Y")
plt.plot(panel_pos_track[:, 2], label="Z")

plt.show(block=True)
plt.ylim((-300, -250))
```

See details in my video, good luck for your experiment! :stuck_out_tongue::blush:

