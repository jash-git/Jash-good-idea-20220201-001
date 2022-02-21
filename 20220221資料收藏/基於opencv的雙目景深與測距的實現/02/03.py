import numpy as np


####################僅僅是一個示例###################################


# 雙目相機參數
class stereoCamera(object):
    def __init__(self):
        # 左相機內參
        self.cam_matrix_left = np.array([[1.7194144252155763e+03, 0., 9.7396489099720088e+02],
                                         [0., 1.7246889040992207e+03, 7.2576405550055301e+02],
                                         [0., 0., 1.]])
        # 右相機內參
        self.cam_matrix_right = np.array([[1.7168908152154356e+03, 0., 1.0331466361439373e+03],
                                          [0., 1.7231083606687728e+03, 6.9119005559789980e+02],
                                          [0., 0., 1.]])

        # 左右相機畸變係數:[k1, k2, p1, p2, k3]
        self.distortion_l = np.array([[-3.2711698432703697e-02, 3.0201589505434645e-01, 1.6164832687546133e-03, -1.5307103949639481e-03, -6.5702545723666506e-01 ]])

        self.distortion_r = np.array([[6.1121002128546979e-03, 4.5640248780657124e-02, -1.1521856958691723e-04, 3.9286522313315160e-04, -1.5110418136803452e-01]])

        # 旋轉矩陣
        self.R = np.array([[9.9982555748461588e-01, 6.9424710407812562e-04, -1.8664742739603710e-02],
                           [-5.1500594643885927e-04, 9.9995372594119614e-01, 9.6062867537008659e-03],
                           [1.8670548182960316e-02, -9.5949985553764033e-03, 9.9977964903936212e-01]])

        # 平移矩陣
        self.T = np.array([[-200.76066765491348], [0.13810237368766151], [-1.6774635597438009]])

        # 焦距
        self.focal_length = 1764.82558    # 默認值，一般取立體校正後的重投影矩陣Q中的 Q[2,3]

        # 基線距離
        self.baseline = 200.76066765491348    # 單位：mm， 爲平移向量的第一個參數（取絕對值）
