# 計算目標框視差--模板匹配
# 假定：所標選的框內所有點具有相同的視差或深度
def disparity_box(left_img, right_img, xmin, ymin, xmax, ymax):
    # 模板
    template = left_img[ymin:ymax, xmin:xmax]

    # 搜索圖
    height = right_img.shape[0]
    yi = ymin - 10
    yu = ymax + 10
    if yi < 0: yi = 0
    if yu > height: yu = height
    search = right_img[yi:yu, :]

    # 模板匹配
    res = cv2.matchTemplate(search, template, cv2.TM_CCOEFF_NORMED)
    minVal, maxVal, minLoc, maxLoc = cv2.minMaxLoc(res)
    h = ymax - ymin
    w = xmax - xmin
    lu = (maxLoc[0], maxLoc[1] + yi)   # 左上角座標（注意:取maxLoc還是minLoc取決於所選擇的相似度量）
    rb = (maxLoc[0] + w, maxLoc[1] + yi + h)   # 右下角座標

    # 視差計算
    disparity = abs(maxLoc[0] - xmin)

    return disparity, lu, rb
