let currentGroupId = null;
let currentChannelId = null;
let currentMatchId = null;

document.addEventListener("DOMContentLoaded", () => {
    loadGroups();
    loadGroupsInSelect();
    loadChannelsInSelect();
    loadMatches();
});

function showPage(pageId) {
    document.querySelectorAll(".page").forEach((page) => {
        page.style.display = "none";
    });
    document.getElementById(pageId).style.display = "block";
}

function loadGroupsInSelect() {
    const groupSelect = document.getElementById("channel-group");
    if (groupSelect) {
        groupSelect.innerHTML = "<option value=''>اختر مجموعة</option>";

        db.collection("groups")
            .orderBy("createdAt", "asc")
            .get()
            .then((querySnapshot) => {
                querySnapshot.forEach((doc) => {
                    const option = document.createElement("option");
                    option.value = doc.id;
                    option.textContent = doc.data().name;
                    groupSelect.appendChild(option);
                });
            });
    }
}

function loadChannelsInSelect() {
    const channelSelect = document.getElementById("match-channel");
    const editChannelSelect = document.getElementById("edit-match-channel");
    if (channelSelect && editChannelSelect) {
        channelSelect.innerHTML = "<option value=''>اختر قناة</option>";
        editChannelSelect.innerHTML = "<option value=''>اختر قناة</option>";

        db.collection("channels")
            .orderBy("createdAt", "asc")
            .get()
            .then((querySnapshot) => {
                querySnapshot.forEach((doc) => {
                    const channel = doc.data();
                    const option = document.createElement("option");
                    option.value = doc.id;
                    option.textContent = channel.name;
                    channelSelect.appendChild(option.cloneNode(true));
                    editChannelSelect.appendChild(option);
                });
            });
    }
}

function loadGroups() {
    const groupsList = document.getElementById("groups-list");
    if (groupsList) {
        groupsList.innerHTML = "";

        db.collection("groups")
            .orderBy("createdAt", "asc")
            .get()
            .then((querySnapshot) => {
                querySnapshot.forEach((doc) => {
                    const group = doc.data();
                    const groupItem = document.createElement("div");
                    groupItem.classList.add("group-item");
                    groupItem.innerHTML = `
                        <span>${group.name}</span>
                        <div>
                            <button onclick="editGroup('${doc.id}')">تعديل</button>
                            <button onclick="deleteGroup('${doc.id}')">حذف</button>
                            <button onclick="viewChannels('${doc.id}')">عرض القنوات</button>
                        </div>
                    `;
                    groupsList.appendChild(groupItem);
                });
            });
    }
}

function loadChannels(groupId) {
    const channelsGrid = document.getElementById("channels-grid");
    if (channelsGrid) {
        channelsGrid.innerHTML = "";

        db.collection("channels")
            .where("group", "==", groupId)
            .orderBy("createdAt", "asc")
            .get()
            .then((querySnapshot) => {
                querySnapshot.forEach((doc) => {
                    const channel = doc.data();
                    const channelCard = document.createElement("div");
                    channelCard.classList.add("channel-card");
                    channelCard.innerHTML = `
                        <img src="${channel.image}" alt="${channel.name}">
                        <p>${channel.name}</p>
                        <button onclick="editChannel('${doc.id}')">تعديل</button>
                        <button onclick="deleteChannel('${doc.id}')">حذف</button>
                    `;
                    channelsGrid.appendChild(channelCard);
                });
            });
    }
}

function viewChannels(groupId) {
    currentGroupId = groupId;
    showPage("view-channels");
    loadChannels(groupId);
}

document.getElementById("add-group-btn").addEventListener("click", () => {
    const groupName = document.getElementById("group-name").value;
    if (groupName) {
        db.collection("groups").add({
            name: groupName,
            createdAt: firebase.firestore.FieldValue.serverTimestamp()
        }).then(() => {
            alert("تمت إضافة المجموعة بنجاح");
            loadGroups();
            loadGroupsInSelect();
        }).catch((error) => alert("حدث خطأ: " + error));
    }
});

function editGroup(groupId) {
    const newName = prompt("أدخل الاسم الجديد للمجموعة:");
    if (newName) {
        db.collection("groups").doc(groupId).update({ name: newName })
            .then(() => {
                alert("تم تعديل المجموعة بنجاح");
                loadGroups();
                loadGroupsInSelect();
            })
            .catch((error) => alert("حدث خطأ: " + error));
    }
}

function deleteGroup(groupId) {
    if (confirm("هل أنت متأكد من حذف هذه المجموعة؟")) {
        db.collection("groups").doc(groupId).delete()
            .then(() => {
                alert("تم حذف المجموعة بنجاح");
                loadGroups();
                loadGroupsInSelect();
            })
            .catch((error) => alert("حدث خطأ: " + error));
    }
}

document.getElementById("add-channel-btn").addEventListener("click", () => {
    const channelName = document.getElementById("channel-name").value;
    const channelUrl = document.getElementById("channel-url").value;
    const channelImage = document.getElementById("channel-image").value;
    const channelKey = document.getElementById("channel-key").value; // Key ID:Key
    const channelGroup = document.getElementById("channel-group").value;

    if (channelName && channelUrl && channelImage && channelGroup) {
        db.collection("channels").add({
            name: channelName,
            url: channelUrl,
            image: channelImage,
            key: channelKey || "", // Key ID:Key (اختياري)
            group: channelGroup,
            createdAt: firebase.firestore.FieldValue.serverTimestamp()
        }).then(() => {
            alert("تمت إضافة القناة بنجاح");
            loadChannels(channelGroup);
            showPage("view-channels");
        }).catch((error) => alert("حدث خطأ: " + error));
    } else {
        alert("يرجى ملء جميع الحقول المطلوبة");
    }
});

function editChannel(channelId) {
    currentChannelId = channelId;
    db.collection("channels").doc(channelId).get().then((doc) => {
        const channel = doc.data();
        document.getElementById("channel-name").value = channel.name;
        document.getElementById("channel-url").value = channel.url;
        document.getElementById("channel-image").value = channel.image;
        document.getElementById("channel-key").value = channel.key || ""; // Key ID:Key
        document.getElementById("channel-group").value = channel.group;

        document.getElementById("add-channel-btn").style.display = "none";
        document.getElementById("edit-channel-btn").style.display = "inline-block";

        showPage("add-channel");
    });
}

document.getElementById("edit-channel-btn").addEventListener("click", () => {
    const name = document.getElementById("channel-name").value;
    const url = document.getElementById("channel-url").value;
    const image = document.getElementById("channel-image").value;
    const key = document.getElementById("channel-key").value; // Key ID:Key
    const group = document.getElementById("channel-group").value;

    if (name && url && image && group) {
        db.collection("channels").doc(currentChannelId).update({
            name: name,
            url: url,
            image: image,
            key: key || "", // Key ID:Key (اختياري)
            group: group
        }).then(() => {
            alert("تم تعديل القناة بنجاح");
            loadChannels(currentGroupId);
            showPage("view-channels");
        }).catch((error) => alert("حدث خطأ: " + error));
    } else {
        alert("يرجى ملء جميع الحقول المطلوبة");
    }
});

function deleteChannel(channelId) {
    if (confirm("هل أنت متأكد من حذف هذه القناة؟")) {
        db.collection("channels").doc(channelId).delete()
            .then(() => {
                alert("تم حذف القناة بنجاح");
                loadChannels(currentGroupId);
            })
            .catch((error) => alert("حدث خطأ: " + error));
    }
}

document.getElementById("add-match-btn").addEventListener("click", () => {
    const team1 = document.getElementById("team1").value;
    const team2 = document.getElementById("team2").value;
    const team1Image = document.getElementById("team1-image").value;
    const team2Image = document.getElementById("team2-image").value;
    const matchTime = document.getElementById("match-time").value;
    const matchLeague = document.getElementById("match-league").value;
    const commentator = document.getElementById("commentator").value;
    const channelUrl = document.getElementById("match-channel-url").value; // رابط القناة (مطلوب)
    const channelKey = document.getElementById("match-channel-key").value; // Key ID:Key (اختياري)

    // التأكد من أن جميع الحقول المطلوبة مملوءة
    if (team1 && team2 && team1Image && team2Image && matchTime && matchLeague && commentator && channelUrl) {
        const matchTimeUTC = new Date(matchTime).toISOString(); // تحويل الوقت إلى تنسيق UTC

        db.collection("matches").add({
            team1: team1,
            team2: team2,
            team1Image: team1Image,
            team2Image: team2Image,
            matchTime: matchTimeUTC,
            matchLeague: matchLeague,
            commentator: commentator,
            channelUrl: channelUrl, // رابط القناة (مطلوب)
            key: channelKey || "", // Key ID:Key (اختياري)
            createdAt: firebase.firestore.FieldValue.serverTimestamp() // وقت الإنشاء
        }).then(() => {
            alert("تمت إضافة المباراة بنجاح");
            loadMatches(); // إعادة تحميل المباريات بعد الإضافة
        }).catch((error) => {
            console.error("حدث خطأ أثناء إضافة المباراة:", error);
            alert("حدث خطأ: " + error.message);
        });
    } else {
        alert("يرجى ملء جميع الحقول المطلوبة");
    }
});
function loadMatches() {
    const matchesGrid = document.getElementById("matches-grid");
    if (matchesGrid) {
        matchesGrid.innerHTML = "";

        db.collection("matches")
            .orderBy("createdAt", "asc")
            .get()
            .then((querySnapshot) => {
                querySnapshot.forEach((doc) => {
                    const match = doc.data();
                    const matchCard = document.createElement("div");
                    matchCard.classList.add("match-card");
                    matchCard.innerHTML = `
                        <p>${match.team1} vs ${match.team2}</p>
                        <p>الوقت: ${new Date(match.matchTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</p>
                        <p>الدوري: ${match.matchLeague}</p>
                        <p>المعلق: ${match.commentator}</p>
                        <p>القناة: ${match.channelUrl}</p>
                        <button onclick="editMatch('${doc.id}')">تعديل</button>
                        <button onclick="deleteMatch('${doc.id}')">حذف</button>
                    `;
                    matchesGrid.appendChild(matchCard);
                });
            }).catch((error) => {
                console.error("حدث خطأ أثناء تحميل المباريات:", error);
                alert("حدث خطأ: " + error.message);
            });
    }
}

function editMatch(matchId) {
    currentMatchId = matchId;
    db.collection("matches").doc(matchId).get().then((doc) => {
        if (doc.exists) {
            const match = doc.data();
            document.getElementById("edit-team1").value = match.team1;
            document.getElementById("edit-team2").value = match.team2;
            document.getElementById("edit-team1-image").value = match.team1Image;
            document.getElementById("edit-team2-image").value = match.team2Image;
            document.getElementById("edit-match-time").value = new Date(match.matchTime).toISOString().slice(0, 16);
            document.getElementById("edit-match-league").value = match.matchLeague;
            document.getElementById("edit-commentator").value = match.commentator;
            document.getElementById("edit-channel-url").value = match.channelUrl || ""; // رابط القناة (مطلوب)
            document.getElementById("edit-channel-key").value = match.key || ""; // Key ID:Key (اختياري)

            showPage("edit-match");
        } else {
            alert("المباراة غير موجودة");
        }
    }).catch((error) => {
        console.error("حدث خطأ أثناء تحميل المباراة:", error);
        alert("حدث خطأ: " + error.message);
    });
}

document.getElementById("save-match-btn").addEventListener("click", () => {
    const team1 = document.getElementById("edit-team1").value;
    const team2 = document.getElementById("edit-team2").value;
    const team1Image = document.getElementById("edit-team1-image").value;
    const team2Image = document.getElementById("edit-team2-image").value;
    const matchTime = document.getElementById("edit-match-time").value;
    const matchLeague = document.getElementById("edit-match-league").value;
    const commentator = document.getElementById("edit-commentator").value;
    const channelUrl = document.getElementById("edit-channel-url").value; // رابط القناة (مطلوب)
    const channelKey = document.getElementById("edit-channel-key").value; // Key ID:Key (اختياري)

    if (team1 && team2 && team1Image && team2Image && matchTime && matchLeague && commentator && channelUrl) {
        const matchTimeUTC = new Date(matchTime).toISOString(); // تحويل الوقت إلى تنسيق UTC

        db.collection("matches").doc(currentMatchId).update({
            team1: team1,
            team2: team2,
            team1Image: team1Image,
            team2Image: team2Image,
            matchTime: matchTimeUTC,
            matchLeague: matchLeague,
            commentator: commentator,
            channelUrl: channelUrl, // رابط القناة (مطلوب)
            key: channelKey || "", // Key ID:Key (اختياري)
        }).then(() => {
            alert("تم تعديل المباراة بنجاح");
            loadMatches(); // إعادة تحميل المباريات بعد التعديل
            showPage("view-matches"); // العودة إلى صفحة عرض المباريات
        }).catch((error) => {
            console.error("حدث خطأ أثناء تعديل المباراة:", error);
            alert("حدث خطأ: " + error.message);
        });
    } else {
        alert("يرجى ملء جميع الحقول المطلوبة");
    }
});
function deleteMatch(matchId) {
    if (confirm("هل أنت متأكد من حذف هذه المباراة؟")) {
        db.collection("matches").doc(matchId).delete()
            .then(() => {
                alert("تم حذف المباراة بنجاح");
                loadMatches(); // إعادة تحميل المباريات بعد الحذف
            }).catch((error) => {
                console.error("حدث خطأ أثناء حذف المباراة:", error);
                alert("حدث خطأ: " + error.message);
            });
    }
}
